<?php

use App\Http\Controllers\Backend\Quotation\POController;
use App\Http\Controllers\Backend\Quotation\QuotationController;
use App\Http\Controllers\Backend\Quotation\QuotationTypeController;
use Illuminate\Routing\Router;

Route::group([], function (Router $router){

    $router->resource('quotation-type', QuotationTypeController::class);
    $router->resource('quotation', QuotationController::class);

    $router->get('quotation/{quotation}/{quotation_number}/view', [QuotationController::class,'view'])
        ->name('quotation.view');
    $router->get('quotation/{quotation}/{quotation_number}/pdf', [QuotationController::class,'pdf'])
        ->name('quotation.pdf');
    $router->get('quotation/{quotation}/{quotation_number}/confirm', [QuotationController::class,'confirm'])
        ->name('quotation.confirm');
    $router->get('quotation/{quotation}/{quotation_number}/confirm-cancel', [QuotationController::class,'confirmCancel'])
        ->name('quotation.cancel-confirm');



    $router->get('po-list', [POController::class, 'index'])
        ->name('po.list');
    $router->get('po/{quotation}/{quotation_number}/view', [POController::class,'view'])
        ->name('po.view');
    $router->post('po/{quotation}/{quotation_number}/confirm-cancel', [POController::class,'poConfirmCancel'])
        ->name('po.cancel-confirm');

});
