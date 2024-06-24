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
    <div class="flex justify-between">
        <x-primary-button type="button"> <a href='{{url("links/get_pdf/$template->uuid")}}'> {{ __('Get PDF')}}</a></x-primary-button>
        <form wire:submit="gen_links">
            <input type="number" wire:model="add_count" id="">
            <x-buttons.primary type="submit">{{ __('Add links')}}</x-buttons.primary>
        </form>
    </div>
    <table class="w-full">
        <thead>
            <tr>
                <th>{{__("Link")}}</th>
                <th>{{__('Alias')}}</th>
                <th>{{__('Began') }}</th>
                <th>{{__('Complete')}}</th>
                <th>{{__('Canceled')}}</th>
                <th>{{__('Used')}}</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
        @foreach ($links as $link)
            <tr>
                <td>
                    <a href='{{ url("worksheet/$template->uuid/$link->alias") }}'>{{ url("worksheet/$template->uuid/$link->alias") }}</a>
                </td>
                <td>{{ $link->alias }}</td>
                <td>{{ $link->began }}</td>
                <td>{{ $link->complete }}</td>
                <td>{{ $link->canceled }}</td>
                <td>{{ $link->used }}</td>
                <td>
                    <x-buttons.secondary  wire:click="delete_link('{{ $link->uuid }}')">
                        {{__('Remove')}}
                    </x-buttons.secondary>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
