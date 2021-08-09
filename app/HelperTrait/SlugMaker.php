<?php


namespace App\HelperTrait;


use Illuminate\Support\Str;

trait SlugMaker
{
    public function getSlug($name, $model): string
    {
        return $this->makeSlug($name, $model);
    }

    private function makeSlug($name, $model): string
    {
        $name = $name.'-'.$this->getUniqueId($model);

        return Str::slug($name);
    }

    private function getUniqueId($model): int
    {
        return $model::query()->max('id')+1;
    }
}
