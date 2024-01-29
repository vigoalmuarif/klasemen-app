<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\StandingsController;
use App\Http\Controllers\VersusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [StandingsController::class, 'index']);

Route::resource('klub', ClubController::class);
Route::resource('match', VersusController::class);
Route::resource('klasemen', StandingsController::class);


Route::get('/wilayah/provinces', [WilayahController::class, 'provinces']);
Route::get('/wilayah/regencies', [WilayahController::class, 'regencies']);