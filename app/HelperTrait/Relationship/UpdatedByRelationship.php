<?php


namespace App\HelperTrait\Relationship;


use App\Models\User;

trait UpdatedByRelationship
{
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select(['id', 'name']);
    }
}
