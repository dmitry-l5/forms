<?php

use function Livewire\Volt\{state};
use Livewire\Volt\Component;
use App\Models\FormTemplate;
use App\Models\Links;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

 new
    #[Layout('components.layouts.app')]
    class extends Component{
        public $add_count = 0;
        public Collection $links;
        public $blank_url = '';
        #[Url]
        public FormTemplate $template;
        public function mount( )
        {
            $this->links = Links::where(['template_id'=>$this->template->id])->get();
        }
        public function gen_links()
        {
            $count = intval($this->add_count);
            if($count){
                DB::transaction(function () use ($count) {
                    for ($i=0; $i < $count ; $i++) {
                        Links::create([
                            'uuid'=>Str::uuid(),
                            'template_id'=>$this->template->id,
                            'answer_id'=>0,
                            'alias'=>Str::random(10)
                        ]);
                    }
                });
                $this->links = Links::where(['template_id'=>$this->template->id])->get();
            }
        }
        public function release_link($uuid)
        {
            $link =  Links::where(['uuid'=>$uuid])->first();
            if($link){
                $link->used = true;
                $link->save();
                $this->mount();
            }
        }
        public function delete_link($uuid)
        {
            $this->uuid_test = $uuid;
            $link =  Links::where(['uuid'=>$uuid])->first();
            if($link){
                $link->delete();
                $this->links = $this->links->except($link->id);
            }
        }
        public function get_pdf(){

            $result = [];
            $items = (object)[];
            $pdf = Pdf::loadView('pdf.r', compact('result', 'items'));
            return $pdf->download('oppa.pdf');
            return $pdf->stream();
            return response()->download();
        }
    }
?>

<div>
    <div id="copied_board" class="left-0 top-0 fixed w-full border border-red-700 flex justify-center" style="display: none">
        <div class=" p-5">
            <div class="p-5 rounded-lg border-2 border-emerald-800 bg-emerald-600 text-emerald-50 bold">
                {{ __('Link copied to clipboard') }}
            </div>
        </div>
    </div>
    <div class="flex justify-between py-3">
        <x-primary-button type="button"> <a href='{{url("links/get_pdf/$template->uuid")}}'> {{ __('Get PDF')}}</a></x-primary-button>
        <form wire:submit="gen_links">
            <input type="number" wire:model="add_count" id="">
            <x-buttons.primary type="submit">{{ __('Add links')}}</x-buttons.primary>
        </form>
    </div>
    <table class="w-full py-3">
        <thead>
            <tr>
                <th>{{__("Link")}}</th>
                {{-- <th>{{__('Alias')}}</th> --}}
                <th>{{__('Began') }}</th>
                <th>{{__('Complete')}}</th>
                {{-- <th>{{__('Canceled')}}</th>--}}
                <th>{{__('Used')}}</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
        @foreach ($links as $link)
            <tr class=" border-b-8 border-slate-300">
                <td>
                    <a onclick="copy(event)" href='{{ "/worksheet/$template->uuid/$link->alias" }}'>{{ url("worksheet/$template->uuid/$link->alias") }}</a>
                </td>
                {{-- <td>{{ $link->alias }}</td> --}}
                <td>{{ $link->began }}</td>
                <td>{{ $link->complete }}</td>
                {{-- <td>{{ $link->canceled }}</td>
                <td>{{ $link->used }}</td> --}}
                <td class="text-end">
                    @if ( !$link->used )
                    <x-buttons.info  wire:click="release_link('{{ $link->uuid }}')">
                        {{__('Release')}}
                    </x-buttons.info>
                    @else
                        <x-buttons.secondary type="button">{{ __("Released") }}</x-buttons.secondary>
                    @endif
                    <x-buttons.delete  wire:click="delete_link('{{ $link->uuid }}')">
                        {{__('Remove')}}
                    </x-buttons.delete>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <script>
        function copy(e){
            e.preventDefault();
            navigator.clipboard.writeText(e.target.href);
            copied_board.style = '';
            setTimeout(() => {
                copied_board.style = 'display:none';
            }, 1000);
        }
    </script>
</div>
