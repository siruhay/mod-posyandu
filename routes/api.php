<?php

use Illuminate\Support\Facades\Route;
use Module\Posyandu\Http\Controllers\DashboardController;
use Module\Posyandu\Http\Controllers\PosyanduServiceController;
use Module\Posyandu\Http\Controllers\PosyanduActivityController;
use Module\Posyandu\Http\Controllers\PosyanduCategoryController;
use Module\Posyandu\Http\Controllers\PosyanduDocumentController;
use Module\Posyandu\Http\Controllers\PosyanduComplaintController;
use Module\Posyandu\Http\Controllers\PosyanduBeneficiaryController;

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('complaint', PosyanduComplaintController::class)->parameters(['complaint' => 'posyanduComplaint']);
Route::resource('activity', PosyanduActivityController::class)->parameters(['activity' => 'posyanduActivity']);
Route::resource('beneficiary', PosyanduBeneficiaryController::class)->parameters(['beneficiary' => 'posyanduBeneficiary']);
Route::resource('service', PosyanduServiceController::class)->parameters(['service' => 'posyanduService']);
Route::resource('category', PosyanduCategoryController::class)->parameters(['category' => 'posyanduCategory']);
Route::resource('document', PosyanduDocumentController::class)->parameters(['document' => 'posyanduDocument']);
