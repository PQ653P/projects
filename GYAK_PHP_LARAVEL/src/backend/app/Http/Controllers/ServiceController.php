<?php

namespace App\Http\Controllers;

use App\Actions\FileManager;
use App\Filters\ServiceFilter;
use App\Http\Requests\ExtendedFormRequest;
use App\Http\Requests\ServicePatchRequest;
use App\Http\Requests\ServicePutRequest;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Image;
use App\Models\Service;
use App\Models\User;
use App\Utils\StatusCode;
use Auth;
use Illuminate\Http\JsonResponse;

class ServiceController extends GuardedController
{
    protected array $except = ['show', 'index'];
    public function index(): JsonResponse
    {
        $result = Service::filterWith(ServiceFilter::class)->through('name', 'server', 'extra')
            ->builder->latest()->with('appointments')->with('user')->with('images')
            ->paginate();
        return response()->json($result);
    }
    public function show(Service $service): JsonResponse
    {
        return response()->json(ServiceResource::make($service));
    }

    public function store(ServiceStoreRequest $request): JsonResponse
    {
        $rq = $request->validated();
        /**
         * @var Service $service
         */
        $service = Service::make($request->except('image'));
        if ($request->has('image')) {
            $src = FileManager::upload('image', 'services');
            $service->images()->attach(Image::create(['src'=> $src]));
        }
        if (!$request->has('server') && !Auth::user()->isServer()) abort(StatusCode::UNPROCESSABLE_ENTITY);

        $service->user()->associate(User::find(request('server', Auth::id())));
        $service->save();

        return response()->json(ServiceResource::make($service),StatusCode::CREATED);
    }
    public function update(ServicePutRequest $request, Service $service): JsonResponse
    {
        return $this->updateLogic($request, $service);
    }

    public function patch(ServicePatchRequest $request, Service $service): JsonResponse
    {
        return $this->updateLogic($request, $service);
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();
        return response()->json([], StatusCode::ACCEPTED);
    }

    private function updateLogic(ExtendedFormRequest $request,Service $service): JsonResponse
    {
        $rq = $request->validated();
        if($rq['image_changed']){
            $service->images()->detach($service->images()->first());
            $src = FileManager::upload('image', 'services');
            $service->images()->attach(Image::create(['src'=>$src]));
        }
        $service->update($request->except('image','image_changed'));
        $service->save();

        return response()->json(ServiceResource::make($service),StatusCode::ACCEPTED);
    }
}
