<?php

namespace App\Http\Controllers;

use App\Filters\TenantFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExtendedFormRequest;
use App\Http\Requests\TenantPatchRequest;
use App\Http\Requests\TenantPutRequest;
use App\Http\Requests\TenantStoreRequest;
use App\Models\Tenant;
use App\Utils\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends GuardedController
{
    protected array $except = ['index'];

    public function index(): JsonResponse
    {
        $result = Tenant::filterWith(TenantFilter::class)->through('name', 'extra')->builder->latest()->paginate();
        return response()->json($result);
    }

    public function show(Tenant $tenant): JsonResponse
    {
        return response()->json($tenant);
    }

    public function store(TenantStoreRequest $request): JsonResponse
    {
        $rq = $request->validated();
        if (!$request->has('extra'))
        {
            $rq['extra'] = null;
        }
        $tenant = Tenant::create($rq);
        $tenant->save();

        return response()->json(Tenant::create($tenant),StatusCode::CREATED);
    }

    public function put(TenantPutRequest $request, Tenant $tenant): JsonResponse
    {
        return $this->updateLogic($request, $tenant);
    }

    public function patch(TenantPatchRequest $request, Tenant $tenant): JsonResponse
    {
        return $this->updateLogic($request, $tenant);
    }

    public function destroy(Tenant $tenant): JsonResponse
    {
        $tenant->delete();
        return response()->json([], StatusCode::ACCEPTED);
    }

    private function updateLogic($request,Tenant $tenant): JsonResponse
    {
        $tenant->update($request->validated());
        $tenant->save();

        return response()->json($tenant,StatusCode::ACCEPTED);
    }
}
