<x-layouts.guest>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
        $index = 0;
        $count = count($data->items);
        $index_option = 1;
        //dd($count);
    @endphp

        <dialog closed id='message' class='border border-black w-full h-full m-0 p-0 bg-zinc-500 bg-opacity-50 absolute top-0 left-0 flex justify-center items-center' style="display: none;" >
            <div id='message_text' class=' w-[100%] bg-red-500 bg-opacity-70 p-3 border border-red-950 border-2 text-slate-100 text-2xl text-center'>ssdd</div>
        </dialog>
        <script>
            document.addEventListener('message_hide', function(e){
                message_text.innerText = '';
                message.style = 'display:none';
                message.close();
                //alert(e.detail.message);
            });
            document.addEventListener('message', function(e){
                message_text.innerText = e.detail.message;
                message.style = 'display:flex';
                message.show();
                setTimeout(function(){message.style = 'display:none';message.close()}, 1000);
                //alert(e.detail.message);
            });
        </script>

    <div class='h-full p-4 ' x-data="{
            index : 0,
            index_max : {{ $count }},
            start(template, link){
                fetch( '/worksheet/start/'+template+'/'+link, {
                method:'POST',
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With' : 'XMLHttpRequest'
                },
                }
                );
                return;
            },
             }">

             {{-- {{ dd(json_decode($template->data_json)) }} --}}
        <form class='h-full' method="post" action="{{ empty($link)?'/preview_save':( url( config('app.form_prefix').'/store/'.$template->uuid.'/'.$link->uuid) ) }}" id='worksheet' >
            @csrf
            @foreach ($data->items as $item )
            <x-forms.card x-show="index == {{ $index }}" csrf='@csrf' x-data @message="alert('');" url='' class='bg-slate-50'>
                @switch($item->type)
                    @case('header')
                        <x-forms.header title="{{$item->title ?? ''}}" description='{{$item->description ?? ""}}'></x-forms.header>
                        @break
                    @case('checkbox_group')
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            @if (isset($item->options))
                                <x-forms.checkbox_group>
                                    @foreach ( $item->options as $input_name => $title )
                                        <x-forms.checkbox_group_option input_name="{{ $item->input_name }}" name="{{ $input_name }}" title="{{$title}}" index="{{ $index_option++ }}" ></x-forms.checkbox_group_option>
                                    @endforeach
                                </x-forms.checkbox_group>
                            @endif
                        </x-forms.base>
                        <script>
                            function {{ $item->input_name }}_validate(){
                                for(var pair of (new FormData(worksheet)).entries()){
                                    if(pair[0].startsWith('{{$item->input_name}}')){
                                        document.dispatchEvent(new CustomEvent('message_hide', { detail:{message:'Ответьте пожалуйста на вопрос'}, bubbles:true}))
                                        return true;
                                    }
                                }
                                document.dispatchEvent(new CustomEvent('message', { detail:{message:'Ответьте пожалуйста на вопрос'}, bubbles:true}))
                                return false;
                            }
                        </script>
                        @break
                    @case('checkbox')
                        <x-forms.base title="{{$item->title}}" description="">
                            <x-forms.checkbox title="{{$item->title}}" description="{{$item->description}}" name="{{ $item->input_name }}" ></x-forms.checkbox>
                        </x-forms.base>
                        @break
                    @case('textarea')
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            <x-forms.textarea title="{{$item->title}}" description="{{$item->description}}" name="{{ $item->input_name }}" ></x-forms.textarea>
                        </x-forms.base>
                        @break
                    @case('radio_group')
                        <x-forms.base title="{{$item->title}}" description='{{$item->description}}'>
                            @if (isset($item->options))
                                <x-forms.radio_group>
                                    @foreach ( $item->options as $input_name => $title )
                                    <x-forms.radio_group_option input_name="{{ $item->input_name }}" name="{{ $input_name }}" title="{{$title}}" index="{{ $index_option++ }}"></x-forms.radio_group_option>
                                @endforeach
                                </x-forms.radio_group>
                            @endif
                        </x-forms.base>
                        <script>
                            function {{ $item->input_name }}_validate(){
                                for(var pair of (new FormData(worksheet)).entries()){
                                    if(pair[0].startsWith('{{$item->input_name}}')){
                                        document.dispatchEvent(new CustomEvent('message_hide', { detail:{message:'Ответьте пожалуйста на вопрос'}, bubbles:true}))
                                        return true;
                                    }
                                }
                                document.dispatchEvent(new CustomEvent('message', { detail:{message:'Ответьте пожалуйста на вопрос'}, bubbles:true}))
                                return false;
                            }
                        </script>
                        @break
                    @default
                    <x-forms.base title="{{$item->title ?? ''}}" description="{{$item->description ?? ''}}">
                        <span class=" bg-red-200">
                            {{-- {{ dd($item) }} --}}
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
                    @if (empty($link))
                        <x-forms.button_2 x-show="index == 0 "  x-on:click="(e)=>{e.preventDefault(); index++;}">Начать</x-forms.button_2>
                    @else
                        <x-forms.button_2 x-show="index == 0 "  x-on:click="(e)=>{e.preventDefault(); start('{{$template->uuid }}', '{{ empty($link->uuid)?'null':$link->uuid }}' );  index++;}">Начать</x-forms.button_2>
                    @endif
                    @php
                        $input_name = isset($item->input_name)?$item->input_name:null;
                    @endphp
                    <x-forms.button_2 x-show="index > 0 && index < index_max - 1"  x-on:click="(e)=>{e.preventDefault(); if({{$input_name?'true':'false'}} && typeof({{ $input_name }}_validate) == 'function'){ let pass = {{ $input_name.'_validate()' }}; console.log(pass); if(pass){index++;}}else{index++;} }">
                        Следующий
                    </x-forms.button_2>
                    <x-forms.button_2 type="submit" x-show="index == index_max - 1" class="" x-on:click="(e)=>{e.preventDefault(); if({{$input_name?'true':'false'}} && typeof({{ $input_name }}_validate) == 'function'){ let pass = {{ $input_name.'_validate()' }}; console.log(pass); if(pass){worksheet.submit();}}else{worksheet.submit();} }">
                        Завершить
                    </x-forms.button_2>
                </x-slot:control>
                <script>
                    // console.warn( typeof({{ $item->input_name ?? 'default' }}_validate) == 'function'  );
                   // if(typeof({{ $item->input_name ?? 'default' }}_validate()) !=='undefined' ){ {{ $item->input_name ?? 'default' }}_validate();}
                </script>


            </x-forms.card>

                @php($index++)
            @endforeach

        </form>
    </div>
</x-layouts.guest>
