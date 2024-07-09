<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;
use Livewire\Volt\Volt;
use App\Models\FormTemplate;
use App\Models\Links;
use Illuminate\Support\Facades\Cookie;
use Barryvdh\DomPDF\Facade\Pdf;

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
// Route::get('/worksheet/{form_id}', function(string $id){
//     $template = FormTemplate::where(['uuid'=>$id])->first();
//     if( $template ){
//         return view( 'slides', compact('template'));
//     }else{
//         return abort(404);
//     }
// });

// Route::resource('pdf', App\Http\Controllers\TestPDFController::class );

Route::get('pdf', function(){
    $pdf = Pdf::loadView('pdf.test', ['title'=>'TITLE', 'date'=>'12.09.2026', 'users'=>[
        (object)['id'=>100, 'name'=>'NAME','email'=>'oppa@oppa.oppa'],
        (object)['id'=>100, 'name'=>'NAME','email'=>'oppa@oppa.oppa'],
        (object)['id'=>100, 'name'=>'NAME','email'=>'oppa@oppa.oppa'],
        ]]);
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream();
});
// Volt::route('pdf', 'pages.testpdf');
Route::get('expire', function(){
    Cookie::expire('filled_form');
});
Route::view('show', 'show_components');
// Route::get('/worksheet/{form_id}/', [App\Http\Controllers\FormController::class, 'code_form']);
Route::get('/worksheet/{form_id}/{code}', [App\Http\Controllers\FormController::class, 'create']);
Route::post('worksheet/store/{form_uuid}/{code}', [App\Http\Controllers\FormController::class, 'store']);
Route::post('worksheet/start/{form_id}/{code}', [App\Http\Controllers\FormController::class, 'start']);
Route::get('/result/{form_id}/{viwer_id?}', [App\Http\Controllers\ResultController::class, 'show']);

Route::prefix('cabinet')->middleware('auth')->group(function(){
    Volt::route('/', 'pages.cabinet.index');
});
Route::middleware('can:create_forms')->group(function(){
    Route::resource('templates', App\Http\Controllers\FormTemplateController::class);
    Route::prefix('links/')->group(function(){
        Volt::route('template/{template}', 'pages.links.index');
        Route::get('/get_pdf/{uuid}', function(string $uuid){
            $validator = Validator::make(['uuid'=>$uuid], [
                'uuid'=>'required|uuid',
            ]);
            if($validator->fails() )
                return abort(404);
            $template = FormTemplate::where('uuid', $uuid)->first();
            if(!$template)
                return abort(404);

            $links = Links::where(['template_id'=>$template->id])->get();
            $pdf = Pdf::loadView('pdf.links_list', ['links'=>$links, 'template'=>$template]);
            $pdf->setPaper('A4', 'landscape');
            // dd($template, $links);
            return $pdf->stream();
        });
    });
});

// Route::get('form/create/{template}', [App\Http\Controllers\FormController::class, 'create']);
// Route::resource('form', App\Http\Controllers\FormController::class)->except(['create', 'store' ]);



Route::prefix('admin');

//Route::view('/', 'index');
Route::get('/', function(){ return redirect('cabinet');});



//Route::get('pics', function(){ return view('slides');});

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

require __DIR__.'/auth.php';
