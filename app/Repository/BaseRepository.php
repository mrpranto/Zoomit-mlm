<?php


namespace App\Repository;


class BaseRepository
{
    protected $model;

    public function __call($name, $arguments)
    {
        return $this->model->{$name}(...$arguments);
    }
}
