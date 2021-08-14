<?php

use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CommissionSetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WalletController;
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

Route::get('user-registration', [RegisterController::class, 'registerPage'])
    ->name('user-registration.page');

Route::post('user-registration', [RegisterController::class, 'processedRegister'])
    ->name('processed.register');

Route::post('user-login', [RegisterController::class, 'processedLogin'])
    ->name('processed.login');

Route::group(['middleware' => 'auth'], function (Router $router){

    $router->get('/home', [HomeController::class, 'index'])->name('home');

    include __DIR__.'/auth_routes.php';
    include __DIR__.'/profile_routes.php';

    $router->resource('setting', SettingController::class);

    $router->get('commission', [CommissionController::class, 'setCommission'])->name('set.commission');
    $router->post('commission', [CommissionController::class, 'storeCommission'])->name('store.commission');


    $router->get('incomes', [WalletController::class, 'incomes'])->name('incomes');
    $router->get('withdraw', [WalletController::class, 'withdraw'])->name('withdraw');

});
