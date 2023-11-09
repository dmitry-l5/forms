<x-layouts.app>
    <div class="my-2">
        <a href="{{ url('manage/form_templates') }}" class="bg-blue-500 ms-1 px-3 py-1 text-white rounded-lg border border-black">Управление формами</a>
    </div>
    <div class="">
        <table class='border w-full'>
            <thead>
                <tr>
                    <th class="text-start">Форма</th>
                    <th class="text-end">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $template )
                <tr class="border py-1" >
                    <td class="">
                        <div class="">
                            @php($header_arr = array_filter( json_decode($template->data_json)->items, fn($item)=>$item->type=='header')  )
                            <div class="text-xl font-bold">
                                <span>{{ $header_arr[0]->title ?? '***'}}</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <a href="{{ url('form/create/'.$template->id)  }}" class="bg-blue-500 ms-1 px-3 py-1 text-white rounded-lg border border-black">Пройти опрос</a>
                        <a href="{{ url('form/'.$template->id)  }}" class="bg-blue-500 px-3 py-1 text-white rounded-lg border border-black">Просмотр результатов</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>