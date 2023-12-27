<?php
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\FormTemplate;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


use function Livewire\Volt\{state};

new 
    #[Layout('components.layouts.app')] 
    class extends Component{

        public function pdf_download(){
            $pdf = PDF::loadView('pdf.test');
            dd($pdf);
            return $pdf->download() ;
        }
        public function pdf_stream(){
            $pdf = PDF::loadView('pdf.test', []);
            return $pdf->stream() ;
        }

    }
?>

<div class=" h-full p-3">
    <div class="h-full">
        @if ((!config('app.need_email_verification'))|Auth::user()->hasVerifiedEmail())
            @if (Gate::allows('create_forms'))
            <div class="flex justify-start">
                <div wire:click="pdf_download"  class="border border-2 m-3 p-2 bg-orange-300 hover:bg-orange-500">button</div>
                <div wire:click="pdf_stream"    class="border border-2 m-3 p-2 bg-orange-300 hover:bg-orange-500">button</div>
            </div>
            <div class="mb-5">

            </div>
            @endif
        @else
            <livewire:VerifyEmail />
        @endif
        
        </div>
    </div> 