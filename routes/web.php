<?php

use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resource('trips', TripController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

Route::post('trips/{trip}/save-template', [TemplateController::class, 'storeFromTrip'])->name('templates.storeFromTrip');
Route::delete('templates/{template}', [TemplateController::class, 'destroy'])->name('templates.destroy');
