<?php

use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductController;
use Illuminate\Routing\Router;

Route::group([], function (Router $router){

    $router->resource('category', CategoryController::class);
    $router->get('category-export', [CategoryController::class, 'exportCategory'])
        ->name('category.export');

    $router->resource('product', ProductController::class);
    $router->get('product-export', [ProductController::class, 'exportProduct'])
        ->name('product.export');
    $router->post('product-import', [ProductController::class, 'importProduct'])
        ->name('product.import');

});
