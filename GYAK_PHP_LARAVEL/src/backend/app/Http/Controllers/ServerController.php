<?php

namespace App\Http\Controllers;

use App\Filters\ServerFilter;
use App\Models\User;
use App\Utils\Bouncer;
use App\Utils\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class ServerController extends Controller
{
    protected array $except = ['index', 'show'];

    public function index(): JsonResponse
    {
        $result = User::filterWith(ServerFilter::class)->through('nameOrEmail', 'extra')
            ->builder->where('extra->server',true)->with('images')->with('services')
            ->paginate(request('per_page',User::Servers()->count()));

        return response()->json($result);
    }

    public function store(User $user): JsonResponse
    {
        if (!Bouncer::can('add-server', User::class)) abort(StatusCode::FORBIDDEN);
        $user->setExtra('server', true);
        $user->setExtra('description', request('description', ''));
        $user->save();

        return response()->json($user, StatusCode::ACCEPTED);
    }

    public function show(User $server): JsonResponse
    {
        return response()->json(array_merge(
            $server->toArray(),
            ['services' => $server->services()->with('images')->get()->toArray()],
            ['images' => $server->images->toArray()],
            ['appointments' => $server->appointments()->with('service')]
      ));
    }

    public function update(Request $request, User $user): JsonResponse
    {
        if ($request->has('description')) {
            $user->setExtra('description', $request->input('description'));
            $user->save();
        }

        return response()->json($user, StatusCode::ACCEPTED);
    }

    public function destroy(User $server): JsonResponse
    {
        $server->setExtra('server', false);
        $server->save();

        return response()->json($server, StatusCode::ACCEPTED);
    }

    public function workingHour(User $user, Request $request): JsonResponse
    {
        $rq = json_decode($request->getContent(), true);
        $result = [];
        try {
            foreach ($rq as $hour) {
                $temp = [];
                $temp['day'] = $hour['day'];
                $temp['from'] = $hour['from'];
                $temp['to'] = $hour['to'];
                $result[] = $temp;
            }
        } catch (RuntimeException){
            abort(StatusCode::UNPROCESSABLE_ENTITY);
        }

        $user->setExtra('hours', $result);
        $user->save();

        return response()->json($user, StatusCode::CREATED);
    }
}
