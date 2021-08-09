<?php

use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function (Router $router){

    $router->get('/home', [HomeController::class, 'index'])->name('home');

    include __DIR__.'/auth_routes.php';
    include __DIR__.'/profile_routes.php';
    include __DIR__.'/product.php';
    include __DIR__.'/customer.php';
    include __DIR__.'/quotation.php';

    $router->resource('setting', SettingController::class);

    $router->get('delivery_chalan', function (){
       return __t('delivery_chalan');
    });

    $router->get('invoice', function (){
       return __t('invoice');
    });

    $router->get('inventory', function (){
       return __t('inventory');
    });

    $router->get('stock', function (){
       return __t('stock');
    });

    $router->get('accounts', function (){
       return __t('accounts');
    });
});
