<?php

use App\Models\Listing;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
    return view('welcome');
});

// All users
Route::get('/users/register', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/users/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/users/login', [UserController::class, 'authenticate'])->middleware('guest');

// All Listings
Route::get('/listings', [ListingController::class, 'index']);
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show']);