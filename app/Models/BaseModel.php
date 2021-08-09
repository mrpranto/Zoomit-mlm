<?php


namespace App\Models;


use App\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeFilters($query, FilterBuilder $filter): Builder
    {
        return $filter->apply($query);
    }
}
