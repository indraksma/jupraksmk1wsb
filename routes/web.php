<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Home
Route::group(['middleware' => ['auth'], 'prefix' => 'home'], function() {
    Route::get('/', App\Http\Livewire\Home\HomeLivewire::class)->name('home');
});

// Example
Route::group(['middleware' => ['auth', 'role:admin|pokja|guru'], 'prefix' => 'example'], function() {
    Route::get('crud', App\Http\Livewire\Example\CRUDLivewire::class)->name('example.crud');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'users'], function() {
    Route::get('users', App\Http\Livewire\User\User::class)->name('users');
});


