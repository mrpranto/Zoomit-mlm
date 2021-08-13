<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class UsersFilter extends FilterBuilder
{
    public function search($search = null)
    {
        return $this->builder->when($search, function (Builder $builder) use ($search){
            $builder->where('name','Like', '%'.$search.'%')
                ->orWhere('email','Like', '%'.$search.'%')
                ->orWhere('phone','Like', '%'.$search.'%');
        });
    }
}
