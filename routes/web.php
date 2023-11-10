<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\VerifyEmailController;

use Livewire\Volt\Volt;

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


//Volt::route('test', 'pages.test_folder.test');


Route::get('/', function(){ return redirect('form');});
Route::get('form/create/{template}', [App\Http\Controllers\FormController::class, 'create']);
Route::post('form/store/{template}', [App\Http\Controllers\FormController::class, 'store']);
Route::get('form/{form}', [App\Http\Controllers\FormController::class, 'show']);

Volt::route('desk', 'pages.desk.index')
->name('desk');

Route::
    // middleware("auth")->
    prefix('/')->
    group(function () {
    Route::prefix('manage')->group(function(){
    Route::resource('form_templates', App\Http\Controllers\FormTemplateController::class);
    });
    Route::resource('form', App\Http\Controllers\FormController::class)->except(['create', 'store' ]);

    Route::view('/', 'index');
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    
    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

});
//Route::prefix('forms')->group(function(){
//    Route::get('');
//})
//Route::get('forms', 'form_list');
//Route::get('auth_forms', 'auth_form_list');
//Route::get

require __DIR__.'/auth.php';
