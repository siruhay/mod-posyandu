<?php

use Illuminate\Support\Facades\Route;
use Module\Posyandu\Http\Controllers\DashboardController;
use Module\Posyandu\Http\Controllers\PosyanduSubmissionController;

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('submission', PosyanduSubmissionController::class)->parameters(['submission' => 'posyanduSubmission']);
