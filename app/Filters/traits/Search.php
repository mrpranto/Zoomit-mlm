<?php


namespace App\Filters\traits;


use Illuminate\Database\Eloquent\Builder;

trait Search
{
    public function search($search = null)
    {
        return $this->builder->when($search, function (Builder $builder) use ($search) {
            $builder->where('name', 'Like', '%'.$search.'%');
        });
    }
}
