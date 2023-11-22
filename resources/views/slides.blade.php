<x-layouts.app>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
        $index = 0;
        $count = count($data->items);
        //dd($count);
    @endphp

    <div  class='' x-data="{ index : 0, index_max : {{ $count }} }">
        <form method="post" action="{{ url('/') }}" >
            <span x-text="index" ></span>
            index = {{ $index }}
            <br>
            index_max = {{ $count }}
            <br>
            @foreach ($data->items as $item )
            <x-forms.card x-show="index == {{ $index }}" csrf='@csrf' url=''>
                @switch($item->type)
                    @case('header')
                        <x-forms.header title="{{$item->title}}" description='{{$item->description}}' >

                        </x-forms.header>
                        @break
                    @case('checkbox_group')
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.checkbox_group>
                                @foreach ( $item->options as $input_name => $title )
                                    <x-forms.checkbox_group_option name="{{ $input_name }}" title="{{$title}}" >

                                    </x-forms.checkbox_group_option>
                                @endforeach


                            </x-forms.checkbox_group>
                        </x-forms.base>
                    @break

                    @default
                    <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                        <x-forms.checkbox_group>

                        </x-forms.checkbox_group>
                    </x-forms.base>
                    @break

                @endswitch

                <x-slot:control>
                    <button x-on:click="index--" >previous</button>
                    <button x-on:click="(e)=>{e.preventDefault(); index++;}" >next</button>
                </x-slot:control>
            </x-forms.card>

                @php($index++)
            @endforeach

        </form>
    </div>



    

</x-layouts.app>