<x-layouts.guest>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
        $index = 0;
        $count = count($data->items);
        //dd($count);
    @endphp

    <div  class='h-full p-4 ' x-data="{ index : 0, index_max : {{ $count }} }">
        <form class='h-full' method="post" action="{{ url( config('app.form_prefix').'/store/'.$template->alias_id) }}" >
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
                        <script>
                            function {{ $item->input_name }}_validate(){
                                console.warn('oppa --- '+{{ $item->input_name }});
                                return true;
                            }
                        </script>
                        @break
                    @case('checkbox')
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.checkbox title="{{$item->title}}" description="{{$item->description}}" name="{{ $item->input_name }}" ></x-forms.checkbox>
                        </x-forms.base>
                        @break
                    @case('radio_group')
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
                <x-slot:counter>
                    <div class="" x-show="index > 0">
                        <span x-text="index" ></span> {{ __('from') }}
                        <span x-text="index_max - 1"></span>
                    </div>
                </x-slot:counter>
                <x-slot:control class="text-center">
                    <x-forms.button_2 x-show="index > 0"  x-on:click="(e)=>{e.preventDefault(); index--;}">Назад</x-forms.button_2>
                    <x-forms.button_2 x-show="index == 0 "  x-on:click="(e)=>{e.preventDefault(); index++;}">Начать</x-forms.button_2>
                    <x-forms.button_2 x-show="index > 0 && index < index_max - 1"  x-on:click="(e)=>{e.preventDefault(); if(typeof({{ $item->input_name ?? '' }}_validate) == 'function'){if({{ $item->input_name }}_validate()){index++;}}else{index++;}; ;}">Следующий</x-forms.button_2>
                    <x-forms.button_2 type="submit" x-show="index == index_max - 1" class="">Завершить</x-forms.button_2>

                </x-slot:control>
                <script>
                    console.warn( typeof({{ $item->input_name ?? 'default' }}_validate) == 'function'  );
                   // if(typeof({{ $item->input_name ?? 'default' }}_validate()) !=='undefined' ){ {{ $item->input_name ?? 'default' }}_validate();}
                </script>


            </x-forms.card>

                @php($index++)
            @endforeach

        </form>
    </div>
</x-layouts.guest>