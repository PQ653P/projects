<?php

namespace App\Http\Controllers;

use App\Filters\AppointmentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentPatchRequest;
use App\Http\Requests\AppointmentPutRequest;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\ExtendedFormRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Utils\StatusCode;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends GuardedController
{
    protected array $except = ['show', 'index'];
    public function index(): JsonResponse
    {
        $result = Appointment::filterWith(AppointmentFilter::class)->through('requestMaker')->builder->latest()
            ->with('user')->with('service');
        return response()->json($result);
    }
    public function show(Appointment $appointment): JsonResponse
    {
        return response()->json(AppointmentResource::make($appointment));
    }

    public function store(AppointmentStoreRequest $request): JsonResponse
    {
        $rq = $request->validated();
        if (!$request->has('user_id'))
        {
            $rq['user_id'] = Auth::id();
        }
            $appointment = Appointment::create($rq);
            $appointment->save();

        return response()->json(AppointmentResource::make($appointment),StatusCode::CREATED);
    }
    public function put(AppointmentPutRequest $request, Appointment $appointment): JsonResponse
    {
        return $this->updateLogic($request, $appointment);
    }

    public function patch(AppointmentPatchRequest $request, Appointment $appointment): JsonResponse
    {
        return $this->updateLogic($request, $appointment);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();
        return response()->json([], StatusCode::ACCEPTED);
    }

    private function updateLogic(ExtendedFormRequest $request,Appointment $appointment): JsonResponse
    {
        $appointment->update($request->validated());
        $appointment->save();

        return response()->json(AppointmentResource::make(),StatusCode::ACCEPTED);
    }
}
