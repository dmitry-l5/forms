<?php

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

Route::view('/', 'index');
Route::get('/', function(){ return redirect('form');});
Route::view('/test', 'test');
Route::view('/pics', 'slides');
//Route::get('pics', function(){ return view('slides');});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('form/create/{template}', [App\Http\Controllers\FormController::class, 'create']);
Route::post('form/store/{template}', [App\Http\Controllers\FormController::class, 'store']);
Route::resource('form', App\Http\Controllers\FormController::class)->except(['create', 'store' ]);


    // Route::prefix('forms')->group(function(){
    //     Route::get('');
    // })
//Route::get('forms', 'form_list');
//Route::get('auth_forms', 'auth_form_list');
// Route::get
Route::prefix('manage')->group(function(){
    Route::resource('form_templates', App\Http\Controllers\FormTemplateController::class);

});
require __DIR__.'/auth.php';
