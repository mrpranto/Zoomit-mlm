<?php


namespace App\HelperTrait\Relationship;


use App\Models\Backend\Company;

trait CompanyRelationship
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
