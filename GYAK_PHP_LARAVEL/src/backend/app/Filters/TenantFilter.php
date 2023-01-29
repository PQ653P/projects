<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class TenantFilter extends Filter
{
    public function name(Builder $query): Builder
    {
        return $query->where('name', 'LIKE', '%' . request('name') . '%');
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
}
