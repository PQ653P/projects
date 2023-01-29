<?php


namespace App\Http\Controllers;


use App\Models\User;
use App\Utils\StatusCode;

class BouncerController extends Controller
{

    public function assign_role(User $user, string $role) {
        $user->assign($role);
        $user->save();
        return response()->json([], StatusCode::ACCEPTED);
    }

    public function unassign_role(User $user, string $role) {
        $user->retract($role);
        $user->save();
        return response()->json([], StatusCode::ACCEPTED);
    }
}
