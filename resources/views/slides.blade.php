<x-layouts.guest>
    @php
        $data = json_decode($template->data_json);
        //dd($data);
        $index = 0;
        $count = count($data->items);
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

    <div  class='h-full p-4 ' x-data="{ index : 0, index_max : {{ $count }} }">
        <form class='h-full' method="post" action="{{ url( config('app.form_prefix').'/store/'.$template->alias_id) }}" id='worksheet' >
            @csrf
            @foreach ($data->items as $item )
            <x-forms.card x-show="index == {{ $index }}" csrf='@csrf' x-data @message="alert('duykkukfyu');" url='' class='bg-slate-50'>
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
                    @php
                        $input_name = isset($item->input_name)?$item->input_name:null;
                    @endphp
                    <x-forms.button_2 x-show="index > 0 && index < index_max - 1"  x-on:click="(e)=>{e.preventDefault(); if({{$input_name?'true':'false'}} && typeof({{ $input_name }}_validate) == 'function'){ let pass = {{ $input_name.'_validate()' }}; console.log(pass); if(pass){index++;}}else{index++;} }">Следующий</x-forms.button_2>
                    <x-forms.button_2 type="submit" x-show="index == index_max - 1" class="" x-on:click="(e)=>{e.preventDefault(); if({{$input_name?'true':'false'}} && typeof({{ $input_name }}_validate) == 'function'){ let pass = {{ $input_name.'_validate()' }}; console.log(pass); if(pass){worksheet.submit();}}else{worksheet.submit();} }">Завершить</x-forms.button_2>
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