<x-layouts.app>
    <div class="mx-48">
    @foreach ($templates as $template )
        <div class="">
            <a href="{{ url('form/create/'.$template->id)  }}">{{ $template->title}}</a>
        </div>
    @endforeach
    </div>
</x-layouts.app>