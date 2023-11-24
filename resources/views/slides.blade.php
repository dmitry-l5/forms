<x-layouts.app>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
        $index = 0;
        $count = count($data->items);
        //dd($count);
    @endphp

    <div  class='' x-data="{ index : 0, index_max : {{ $count }} }">
        <form method="post" action="{{ url('form/store/'.$template->id) }}" >
            @csrf
            @foreach ($data->items as $item )
            <x-forms.card x-show="index == {{ $index }}" csrf='@csrf' url=''>
                @switch($item->type)
                    @case('header')
                        <x-forms.header title="{{$item->title ?? ''}}" description='{{$item->description ?? ""}}'></x-forms.header>
                        @break
                    @case('checkbox_group')
                    
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.checkbox_group>
                                @foreach ( $item->options as $input_name => $title )
                                    <x-forms.checkbox_group_option input_name="{{ $item->input_name }}" name="{{ $input_name }}" title="{{$title}}" ></x-forms.checkbox_group_option>
                                @endforeach
                            </x-forms.checkbox_group>
                        </x-forms.base>
                        @break
                    @case('checkbox')
                        <div class="">checkbox</div>
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.checkbox title="{{$item->title}}" description="{{$item->description}}" name="{{ $item->input_name }}" ></x-forms.checkbox>
                        </x-forms.base>
                        @break
                    @case('radio_group')
                        <div class="">radio_group</div>
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.radio_group>
                                @foreach ( $item->options as $input_name => $title )
                                <x-forms.radio_group_option input_name="{{ $item->input_name }}" name="{{ $input_name }}" title="{{$title}}" ></x-forms.radio_group_option>
                            @endforeach
                            </x-forms.radio_group>
                        </x-forms.base>
                        @break
                    @default
                    <x-forms.base title="{{$item->title ?? ''}}" description="{{$item->description ?? ''}}">
                        <span class=" bg-red-200">
                            Ошибка: этот тип поля не поддерживается.
                        </span>
                    </x-forms.base>
                    @break
                @endswitch
                <div class="" x-show="index > 0">
                    <span x-text="index" ></span> {{ __('from') }}
                    <span x-text="index_max - 1"></span>
                </div>
                <x-slot:control>
                    <x-forms.button_2 x-show="index > 0"  x-on:click="(e)=>{e.preventDefault(); index--;}">Назад</x-forms.button_2>
                    <x-forms.button_2 x-show="index < index_max - 1"  x-on:click="(e)=>{e.preventDefault(); index++;}">Следующий</x-forms.button_2>
                    <x-forms.button_2 type="submit" x-show="index == index_max - 1">Завершить</x-forms.button_2>
                </x-slot:control>
            </x-forms.card>

                @php($index++)
            @endforeach

        </form>
    </div>



    

</x-layouts.app>