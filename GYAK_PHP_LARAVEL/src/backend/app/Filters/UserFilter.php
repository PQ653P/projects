<?php


namespace App\Filters;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{

    public function nameOrEmail(Builder $query) : Builder {
        return $query->where('name','LIKE', '%' . request('name') . '%')
            ->orWhere('email','LIKE', '%' . request('email') . '%');
    }

    public function extra(Builder $query) : Builder
    {
        $extras = $this->findExtras();
        foreach ($extras as $key => $value) {
            $query = $query->where("extra->$key", "%$value%");
        }
        return $query;
    }

    private function findExtras(): array
    {
        $result = [];
        foreach (request()->all() as $rq) {
            $ex = explode('--',  $rq);
            $result[$ex[0]] = $ex[1];
        }
        return $result;
    }

    public function created_at(Builder $query): Builder
    {
        $dates = explode(' - ',request('date'));
        return $query->where('created_at', '>=', $dates[0])
            ->where('created_at', '<=', $dates[1]);

    }
}
