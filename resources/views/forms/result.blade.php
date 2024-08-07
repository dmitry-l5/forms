<x-layouts.app>
    <div class="p-4 bg-sky-50  h-full">
        <x-forms.card class=' bg-white h-full !overflow-auto'>
            <div class="text-center mb-6">
                <div class="border border-sky-600 p-5 bg-sky-50">
                    Учитываются ответы полученные с момента последнего изменения содержания формы
                    <span class="font-bold">
                        {{ date('d.m.Y H:i', strtotime($template->updated_at)) }}
                    </span>
                </div>
            </div>
            <div class="flex justify-between">
                <x-buttons.link href="{{ url('result_clear/'.$alias) }}">
                    Удалить результаты
                </x-buttons.link>

                <x-buttons.link href="{{ url('result/'.$alias.'/1') }}">
                    Отчёт
                </x-buttons.link>
            </div>
            <div class=""></div>
            @php($header = array_filter($result->items, function($item){
                return $item->type == 'header' ? true : false;
            })[0] ?? null)
            @if ($header)
                <h1 class=' text-center text-4xl py-4 border-b-2 border-sky-800'>{{ $header->title }}</h1>
                <div class="py-2">{{ $header->description }}</div>
            @endif
            @foreach ($result->items as $item)
                @switch($item->type)
                    @case('header')
                        @break
                    @case('textarea')
                        <x-ResultTextarea :data='$item'></x-ResultTextarea>
                        @break
                    @default
                        <x-result_base title="{{  $item->title  }}" description="{{  $item->description  }}">
                            @if(isset($item->result))
                                @foreach ($item->result as $key => $value)
                                    <x-result_line class="py-1" x-data="{ total:{{ $result->data->count }}, count:{{ $value }}, title:'{{  (count((array)$item->result)>1)?$key:null }}' }" percent="{{ $result->data->count?($value/$result->data->count )*100:0 }}"></x-result_line>
                                @endforeach
                            @endif
                        </x-result_base>
                @endswitch
            @endforeach
        </x-forms.card>
    </div>
</x-layouts.app>
