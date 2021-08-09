<?php


namespace App\Services;


class BaseServices
{
    protected $model;

    protected $filter;

    public function __call($name, $arguments)
    {
       $this->model->{$name}($arguments);
    }

    public function setModel($model): BaseServices
    {
        $this->model = $model;
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }
}
