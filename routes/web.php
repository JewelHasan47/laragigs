<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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

// all listings
Route::get( '/', [ ListingController::class, 'index' ] );

// show create form
Route::get( '/listings/create', [ ListingController::class, 'create' ] )->middleware( 'auth' );

// store listing data
Route::post( '/listings', [ ListingController::class, 'store' ] )->middleware( 'auth' );

// edit single listing
Route::get( '/listings/{listing}/edit', [ ListingController::class, 'edit' ] )->middleware( 'auth' );

// update single listing
Route::put( '/listings/{listing}', [ ListingController::class, 'update' ] )->middleware( 'auth' );

// delete single listing
Route::delete( '/listings/{listing}', [ ListingController::class, 'destroy' ] )->middleware( 'auth' );

// manage listings
Route::get( '/listings/manage', [ ListingController::class, 'manage' ] )->middleware( 'auth' );

// single listing
Route::get( '/listings/{listing}', [ ListingController::class, 'show' ] );

// register / form
Route::get( '/register', [ UserController::class, 'index' ] )->middleware( 'guest' );

// create new user
Route::post( '/users', [ UserController::class, 'store' ] );

// logout
Route::post( '/logout', [ UserController::class, 'logout' ] )->middleware( 'auth' );

// show login form
Route::get( '/login', [ UserController::class, 'login' ] )->name( 'login' )->middleware( 'guest' );

// login authenticate
Route::post( '/users/authenticate', [ UserController::class, 'authenticate' ] );




