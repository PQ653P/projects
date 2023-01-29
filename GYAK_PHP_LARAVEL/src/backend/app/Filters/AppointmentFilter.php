<?php


namespace App\Filters;


use App\Models\Appointment;
use App\Models\Service;
use App\Utils\StatusCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AppointmentFilter extends Filter
{
    public function requestMaker(Builder $query): Builder
    {
        $RqFromAdmin = Auth::user()->isAn('admin', 'assistant');
        $RqFromServer = Auth::user()->isA('server');
        $RqFromUser = Auth::user()->isA('user');

        if($RqFromAdmin){
            return $query;
        }
        elseif ($RqFromServer){
            return $query->whereHas('services', function ($q) {
                $q->where('services.user_id','LIKE',Auth::user()->id);
            });
        }
        elseif($RqFromUser){
            return $query->where('user_id','LIKE',  Auth::user()->id);
        }
    }
}
