<x-layouts.guest>
    @php($header = array_filter($result->items, function($item){
        return $item->type == 'header' ? true : false;
    })[0] ?? null)
    @if ($header)
        <h1>{{ $header->title }}</h1>
        <div class="">{{ $header->description }}</div>
    @endif
    @foreach ($result->items as $item)
        <x-result_base title="{{  $item->title  }}" description="{{  $item->description  }}">
            @if(isset($item->result))
                @foreach ($item->result as $key => $value)

                    <x-result_line x-data="{ total:{{ $result->data->count }}, count:{{ $value }}, title:'{{  (count((array)$item->result)>1)?$key:null }}' }" percent="{{ ($value/$result->data->count )*100 }}">
                    ******************************************************************
                    </x-result_line>

            
                @endforeach
            @endif
        </x-result_base>
        <div class="">
            <br>
            {{ var_dump($item)}}
           <br>
        </div>
    @endforeach
<h2>show results</h2>

</x-layouts.guest>
{{ dd( $result) }}