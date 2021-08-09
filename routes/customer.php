<?php

use App\Http\Controllers\Backend\Customer\CompanyController;
use App\Http\Controllers\Backend\Customer\CustomerController;
use Illuminate\Routing\Router;

Route::group([], function (Router $router){

    $router->resource('customer', CustomerController::class);
    $router->resource('company', CompanyController::class);

});
