<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\FormTemplate;

new 
    #[Layout('components.layouts.app')] 
    class extends Component{
        use WithPagination;

        public function with():array{
            return [
                'forms'=>Gate::allows('create_forms')?FormTemplate::where(['author_id'=>Auth::user()->id])->paginate(3):[],
            ];
        }
}; ?>
<div class="">
    @if (Gate::allows('create_forms'))
    <x-forms.link_button_1 href="{{ url('templates/create') }}">{{ __('Create form') }}</x-forms.link_button_1>
        {{-- list you worksheets --}}
        {{ $forms->links() }}
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
                            URL : {{ url(config('app.form_prefix').'/'.$form->alias_id) }}
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

</div> 


