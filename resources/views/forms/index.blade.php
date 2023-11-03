<x-layouts.app>
    <div class="mx-48">
    @foreach ($templates as $template )
        <div class="">
            <span>{{ $template->title}}</span>
            <a href="{{ url('form/create/'.$template->id)  }}">Пройти опрос</a>
            <a href="{{ url('form/create/'.$template->id)  }}">Просмотр результатов</a>
        </div>
    @endforeach
    </div>
</x-layouts.app>