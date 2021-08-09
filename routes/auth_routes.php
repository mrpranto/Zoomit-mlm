<?php

use App\Http\Controllers\Backend\Auth\RoleController;
use App\Http\Controllers\Backend\Auth\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([], function (Router $router){

    $router->resource('roles', RoleController::class);
    $router->resource('users', UserController::class);

});

