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
<div x-data="{show_delete_alert:false, form_id:-1}" class="h-full"><div class="">
    <div x-show='show_delete_alert'  class="fixed left-0 top-0 w-full h-full bg-slate-500  bg-opacity-50 flex justify-center items-center border ">
        <div class=" bg-slate-50 p-10">
            <div class="pb-10 text-center">
                {{ __('Are you sure?') }}
            </div>
            <div class="">
                <x-buttons.secondary x-on:click='form_id = -1; show_delete_alert=false;'>{{ __('Cancel') }}</x-buttons.secondary>
                <x-buttons.delete x-on:click="$wire.delete(form_id); form_id = -1; show_delete_alert=false; ">{{ __('Delete') }}</x-buttons.delete>
            </div>
        </div>
    </div>
</div>
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
                        <td class="border border-slate-700 ps-3" >
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
                            <x-buttons.link_info class="w-full md:w-fit"  href='/preview/{{ $form->uuid}}' >{{ __('Preview') }}</x-buttons.link_info>
                            <x-buttons.link class="w-full md:w-fit"  href='/result/{{ $form->uuid}}'>{{ __('Show results') }}</x-buttons.link >
                            <x-buttons.link class="w-full md:w-fit"  href='/templates/{{ $form->id }}/edit'>{{ __('Edit') }}</x-buttons.link>
                            <x-buttons.link class="w-full md:w-fit"  href='/links/template/{{ $form->id }}'>{{ __('Links') }}</x-buttons.link>
                            <x-buttons.delete  class="w-full md:w-fit" x-on:click="show_delete_alert = true; form_id = {{ $form->id }}" >{{ __('Delete') }}</x-buttons.delete>


                            {{-- <x-buttons.link class="w-full md:w-fit"  href="{{ url('result/'.$form->uuid) }}">{{ __('Show results') }}</x-buttons.link >
                            <x-buttons.link class="w-full md:w-fit" href="{{ url('templates/'.$form->id.'/edit') }}">{{ __('Edit') }}</x-buttons.link>
                            <x-buttons.link class="w-full md:w-fit" href="{{ url('links/template/'.$form->id) }}">{{ __('Links') }}</x-buttons.link>
                            <x-buttons.delete x-on:click="show_delete_alert = true; form_id = {{ $form->id }}" >{{ __('Delete') }}</x-buttons.delete> --}}
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


