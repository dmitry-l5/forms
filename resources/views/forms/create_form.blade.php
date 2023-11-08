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
                    <x-forms.header>
                        <x-slot:title>
                            {{ $item->title}}
                        </x-slot>
                        <x-slot:description>
                            {{ $item->description}}
                        </x-slot>
                    </x-forms.header>
                @else
                    <x-forms.card>
                        <x-slot:title>
                            <label for="{{ $item->input_name }}">
                                {{ $item->title}}
                            </label>
                        </x-slot>
                        <x-slot:description>
                            {{ $item->description}}
                        </x-slot>
                        <x-slot:inputs>
                        @switch($item->type)
                            @case('checkbox_group')
                                    <x-forms.checkbox_group >
                                        @if(isset($item->options))
                                            @foreach ($item->options as $title => $option)
                                            <x-forms.checkbox_group_option :name="$item->input_name" :title="$title" :text="$option">
                                            </x-forms.checkbox_group_option>
                                            @endforeach
                                        @endif
                                    </x-forms.checkbox_group>
                                @break
                                @case('string')
                                    <x-forms.string :name="$item->input_name">
                                    </x-forms.string>
                                @break
                                @case('date')
                                    <x-forms.date :name="$item->input_name">
                                    </x-forms.string>
                                @break
                                @case('number')
                                    <x-forms.number :name="$item->input_name">
                                    </x-forms.string>
                                @break
                            @default
                                <div class=" bg-gray-500">
                                    {{ $item->type }}
                                </div>
                                @break
                        @endswitch
                        </x-slot>
                  
                    </x-forms.card>
                @endif
            </div>
        @endforeach
        <div class="">
            <button class="border border-black px-3 py-1" type="submit">Сохранить</button>
        </div>
        </form>
    </div>
</x-layouts.app>