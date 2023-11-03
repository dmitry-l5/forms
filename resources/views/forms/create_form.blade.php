<x-layouts.app>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
    @endphp
    <div class="mx-48">
        <form action="{{ url('form/store/'.$data->aux->template_id) }}" method="post">
            @csrf
        @foreach ($data->items as $item )
            <div class="">
                @if ($item->type == 'header')
                    <div class="">{{ $item->title}}</div>
                    <div class="">{{ $item->description}}</div>
                @else
                    <div class="">
                        <div class="">{{ $item->title}}</div>
                        <div class="">{{ $item->description}}</div>
                    </div>
                    @switch($item->type)
                        @case('checkbox_group')
                            <div class="">
                                @if(isset($item->options))
                                    @foreach ($item->options as $title => $option)
                                    <label for="{{ $title }}">{{ $option }}</label>
                                    <input type="checkbox" name="{{$item->input_name}}[{{ $title }}]" id="{{ $title }}">
                                    @endforeach
                                @endif
                            </div>
                            @break
                    
                        @default
                            
                    @endswitch
         

                @endif
            </div>
        @endforeach
        <div class="">
            <button class="border border-black px-3 py-1" type="submit">Сохранить</button>
        </div>
        </form>
    </div>
</x-layouts.app>