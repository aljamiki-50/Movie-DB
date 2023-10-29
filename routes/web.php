<?php

use App\Http\Controllers\actorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvContoller;

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

Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MoviesController::class,'show'])->name('movies.show');


// route for my tv show 
Route::get('/', [TvContoller::class, 'index'])->name('tv.index');
Route::get('/tv/{id}', [TvContoller::class, 'show'])->name('tv.show');




// actors controller for actors 
Route::get('/actors', [actorsController::class,'index'])->name('actors');
Route::get('/actors/page/{page?}', [actorsController::class,'index']);

Route::get('/actors/{id}', [actorsController::class,'show'])->name('actors.show');
    




// Route::view('/', 'index');
// Route::view('/movie', 'show');
