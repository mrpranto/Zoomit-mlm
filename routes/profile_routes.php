<?php

use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([], function (Router $router){

    $router->get('profile', [ProfileController::class, 'profile'])->name('profile');
    $router->put('profile/update/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');
    $router->post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    $router->post('profile/social-links', [ProfileController::class, 'socialLinks'])->name('profile.social-links');

});

