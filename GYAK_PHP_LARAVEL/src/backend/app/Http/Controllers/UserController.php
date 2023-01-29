<?php

namespace App\Http\Controllers;

use App\Actions\FileManager;
use App\Filters\UserFilter;
use App\Http\Requests\ExtendedFormRequest;
use App\Http\Requests\UserPatchRequest;
use App\Http\Requests\UserPutRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\User;
use App\Utils\StatusCode;
use Hash;
use Illuminate\Http\JsonResponse;


class UserController extends GuardedController
{
    public function index(): JsonResponse
    {
        $result = User::filterWith(UserFilter::class)->through('nameOrEmail', 'extra', 'created_at')->builder
            ->latest()->with('appointments')->with('images');
        if(request('per_page', '0') !== '0') {
            $result = $result->paginate(request('per_page'));
        }else{
            $result = $result->paginate($result->count());
        }
        return response()->json($result);
    }
    public function show(User $user) :JsonResponse
    {
        return response()->json(UserResource::make($user));
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $rq = $request->validated();
        $src = FileManager::upload('image', 'users');
        /** @var User $user */
        $user = User::make($request->except('image', 'password'));
        if ($request->has('image')) {
            $user->images()->attach(Image::make(['src' => $src]));
        }
        $user->password = Hash::make($rq['password']);
        $user->save();

        return response()->json(UserResource::make($user),StatusCode::CREATED);
    }

    public function update(UserPutRequest $request, User $user): JsonResponse
    {
        return $this->updateLogic($request, $user);
    }

    public function patch(UserPatchRequest $request, User $user): JsonResponse
    {
        return $this->updateLogic($request, $user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([], StatusCode::ACCEPTED);
    }

    private function updateLogic(ExtendedFormRequest $request, User $user): JsonResponse
    {
        $rq = $request->validated();
        if($rq['image_change']){
            $user->images()->detach($user->images()->first());
            $src = FileManager::upload('image', 'users');
            $user->images()->attach(Image::create(['src' => $src]));
        }

        $except = ['image','image_change'];
        if(request('password', '') !== '')
            $user->update($request->except(...$except));
        else
            $user->update($request->except(...[...$except, 'password']));
        $user->save();

        return response()->json(UserResource::make($user),StatusCode::ACCEPTED);
    }

}
