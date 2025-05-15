<?php

use Illuminate\Support\Facades\Route;
use Module\Posyandu\Http\Controllers\DashboardController;


Route::get('dashboard', [DashboardController::class, 'index']);