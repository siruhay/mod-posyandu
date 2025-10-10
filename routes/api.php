<?php

use Illuminate\Support\Facades\Route;
use Module\Posyandu\Http\Controllers\DashboardController;
use Module\Posyandu\Http\Controllers\PosyanduServiceController;
use Module\Posyandu\Http\Controllers\PosyanduCategoryController;
use Module\Posyandu\Http\Controllers\PosyanduDocumentController;

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('service', PosyanduServiceController::class)->parameters(['service' => 'posyanduService']);

Route::resource('category', PosyanduCategoryController::class)->parameters(['category' => 'posyanduCategory']);

Route::resource('document', PosyanduDocumentController::class)->parameters(['document' => 'posyanduDocument']);
