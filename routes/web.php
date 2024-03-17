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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard', ['xcomponent' => "nomenclature"]);
    })->name('dashboard');

    Route::get('/edit', function () {
        return view('dashboard', ['xcomponent' => 'edit']);
    })->name('edit');

    Route::get('/nomenclature', function () {
        return view('dashboard', ['xcomponent' => 'nomenclature']);
    })->name('nomenclature');
});
