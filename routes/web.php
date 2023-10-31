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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

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
