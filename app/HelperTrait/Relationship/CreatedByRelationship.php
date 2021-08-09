<?php


namespace App\HelperTrait\Relationship;


use App\Models\User;

trait CreatedByRelationship
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select(['id', 'name']);
    }
}
