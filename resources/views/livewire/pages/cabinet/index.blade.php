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
                'forms'=>Gate::allows('create_forms')?FormTemplate::where(['author_id'=>Auth::user()->id])->orderBy('updated_at', 'DESC')->paginate(10):[],
            ];
        }
        public function delete($id){
            FormTemplate::where(['id'=>$id, 'author_id'=>Auth::user()->id])->delete();
        }
}; ?>
<div class=" h-full p-3">
<div class="h-full">
    @if ((!config('app.need_email_verification'))|Auth::user()->hasVerifiedEmail())
        @if (Gate::allows('create_forms'))
        <div class="flex justify-start">
            <x-buttons.link href="{{ url('templates/create') }}">
                {{-- <a > --}}
                    + {{ __('Create form') }}
                {{-- </a> --}}
            </x-buttons.link>

        </div>
            {{-- list you worksheets --}}
            <div class="mb-5">
                {{ $forms->links() }}
            </div>
            <table class="w-full border-collapse border border-slate-500 overflow-scroll">
                <thead>
                    <tr>
                        <th class="border border-slate-700 bg-slate-200">Название</th>
                        {{-- <td class="border border-slate-700 bg-slate-200">Ссылки :</td> --}}
                        <th class="border border-slate-700 bg-slate-200">Действия</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($forms as $form)
                    @php(  $header = array_filter( json_decode($form->data_json)->items, function($item){return $item->type == 'header';})[0] ?? null  )
                    <tr class="overflow-scroll">
                        <td class="border border-slate-700" >
                            {{ $header->title ?? '' }}
                        </td>
                        {{-- <td class="border border-slate-700">
                            на форму :
                            <a href="{{ url(config('app.form_prefix').'/'.$form->uuid) }}">
                                {{ url(config('app.form_prefix').'/'.$form->uuid) }}
                            </a>
                            <br>
                            на результаты :
                            <a href="{{ url('result/'.$form->uuid) }}">
                                {{ url('result/'.$form->uuid) }}
                            </a>
                        </td> --}}
                        <td class="border border-slate-700 flex flex-col md:flex-row justify-end items-center grow">
                            <x-buttons.link class="w-full md:w-fit"  href="{{ url('result/'.$form->uuid) }}">{{ __('Show results') }}</x-buttons.link >
                            <x-buttons.link class="w-full md:w-fit" href="{{ url('templates/'.$form->id.'/edit') }}">{{ __('Edit') }}</x-buttons.link>
                            <x-buttons.link class="w-full md:w-fit" href="{{ url('links/template/'.$form->id) }}">{{ __('Links') }}</x-buttons.link>
                            <x-buttons.delete wire:click="delete({{ $form->id }})">{{ __('Delete') }}</x-buttons.delete>
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


