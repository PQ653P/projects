<?php

namespace App\Http\Controllers;

use App\Filters\PostFilter;
use App\Http\Controllers\Controller;
use App\Actions\FileManager;
use App\Http\Requests\ExtendedFormRequest;
use App\Http\Requests\PostPatchRequest;
use App\Http\Requests\PostPutRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use App\Utils\StatusCode;
use Auth;
use Illuminate\Http\JsonResponse;

class PostController extends GuardedController
{
    protected array $except = ['index', 'show'];

    public function index(): JsonResponse
    {
        $result = Post::filterWith(PostFilter::class)->through('title', 'created_at')
            ->builder->latest()->with('images')->with('user');
        if(request('per_page', '0') !== '0') {
            $result = $result->paginate(request('per_page'));
        }else{
            $result = $result->paginate($result->count());
        }
        return response()->json($result);
    }
    public function show(Post $post): JsonResponse
    {
        return response()->json(PostResource::make($post));
    }

    public function store(PostStoreRequest $request ): JsonResponse
    {
        $rq = $request->validated();
        if ($request->has('image'))
            $src = FileManager::upload('image', 'posts');

        /** @var Post $post */
        $post = Post::make($request->except('image'));
        $post->user()->associate(Auth::user());
        $post->save();
        if ($request->has('image'))
            $post->images()->attach(Image::create(['src' => $src]));
        $post->save();

        return response()->json(PostResource::make($post),StatusCode::CREATED);
    }

    public function update(PostPutRequest $request, Post $post): JsonResponse
    {
        return $this->updateLogic($request, $post);
    }

    public function patch(PostPatchRequest $request, Post $post): JsonResponse
    {
        return $this->updateLogic($request, $post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([], StatusCode::ACCEPTED);
    }

    private function updateLogic(ExtendedFormRequest $request,Post $post): JsonResponse
    {
        $rq = $request->validated();
        if($rq['image_change']){
            $post->images()->detach($post->images()->first());
            $src = FileManager::upload('image', 'posts');
            $post->images()->attach(Image::create(['src' => $src]));
        }
        $post->update($request->except('image','image_changed'));
        $post->save();

        return response()->json(PostResource::make($post),StatusCode::ACCEPTED);

    }
}
