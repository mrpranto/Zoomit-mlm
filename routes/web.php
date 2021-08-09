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

    $router->resource('setting', SettingController::class);

});
