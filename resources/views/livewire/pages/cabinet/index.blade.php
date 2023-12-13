<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\FormTemplate;
use Illuminate\Support\Facades\Auth;

new 
    #[Layout('components.layouts.app')] 
    class extends Component{
        use WithPagination;

        public function with():array{
            return [
                'forms'=>Gate::allows('create_forms')?FormTemplate::where(['author_id'=>Auth::user()->id])->paginate(10):[],
            ];
        }
}; ?>
<div class=" h-full p-3">
<div class="h-full">
    @if ((!config('app.need_email_verification'))|Auth::user()->hasVerifiedEmail())
        @if (Gate::allows('create_forms'))
        <div class="flex justify-start">
            <x-buttons.link href="{{ url('templates/create') }}">
                {{-- <a > --}}
                    + Создать форму
                {{-- </a> --}}
            </x-buttons.link>
            <x-forms.link_button_1 href="{{ url('templates/create') }}" class="border border-neutral-500 p-3 m-3  bg-blue-500 text-white">{{ __('Create form') }}</x-forms.link_button_1>
        </div>
            {{-- list you worksheets --}}
            <div class="mb-5">
                {{ $forms->links() }}
            </div>
            <table class="w-full border-collapse border border-slate-500 overflow-scroll">
                <thead>
                    <tr>
                        <td class="border border-slate-700 bg-slate-200">Название</td>
                        <td class="border border-slate-700 bg-slate-200">Ссылка на опрос</td>
                        <td class="border border-slate-700 bg-slate-200">Действия</td>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($forms as $form)
                    @php(  $header = array_filter( json_decode($form->data_json)->items, function($item){return $item->type == 'header';})[0] ?? null  )
                    <tr class="overflow-scroll">
                        <td class="border border-slate-700" >
                            {{ $header->title ?? '' }}
                        </td>
                        <td class="border border-slate-700">
                            <a href="{{ url(config('app.form_prefix').'/'.$form->alias_id) }}">
                                {{ url(config('app.form_prefix').'/'.$form->alias_id) }}
                            </a>
                        </td>
                        <td class="border border-slate-700">
                            <x-forms.link_button_1 href="{{ url('result/'.$form->alias_id) }}">{{ __('Show results') }}</x-forms.link_button_1>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <livewire:VerifyEmail />
    @endif
    
    </div>
</div> 


