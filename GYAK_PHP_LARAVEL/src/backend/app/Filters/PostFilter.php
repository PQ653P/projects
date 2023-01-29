<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class PostFilter extends Filter
{

    public function title(Builder $query): Builder
    {
        return $query->where('title', 'LIKE', '%' . request('title') . '%');
    }

    public function created_at(Builder $query): Builder
    {
        $dates = explode(' - ',request('date'));
        return $query->where('created_at', '>=', $dates[0])
            ->where('created_at', '<=', $dates[1]);
    }
}
