<x-layouts.guest>
    <div class="p-4">
        <x-forms.card class='bg-slate-50'>
            @php($header = array_filter($result->items, function($item){
                return $item->type == 'header' ? true : false;
            })[0] ?? null)
            @if ($header)
                <h1 class=' text-center text-4xl py-4 border-b-2 border-black'>{{ $header->title }}</h1>
                <div class="py-2">{{ $header->description }}</div>
            @endif
            @foreach ($result->items as $item)
            @if ( in_array($item->type, ['header']))
                @continue
            @endif
            <x-result_base title="{{  $item->title  }}" description="{{  $item->description  }}">
                @if(isset($item->result))
                @foreach ($item->result as $key => $value)
                <x-result_line class="py-1" x-data="{ total:{{ $result->data->count }}, count:{{ $value }}, title:'{{  (count((array)$item->result)>1)?$key:null }}' }" percent="{{ $result->data->count?($value/$result->data->count )*100:0 }}">
                    </x-result_line>
                    @endforeach
                    @endif
                </x-result_base>
                @endforeach
        </x-forms.card>
    </div>
</x-layouts.guest>
