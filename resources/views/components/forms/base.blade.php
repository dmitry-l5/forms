@props(['title', 'description'])
<div x-data="{ title:'{{$title}}',description:'{{$description}}' }">
    <h3 x-text="title"></h3>
    <div x-text="description"></div>
    <div class=" bg-lime-200 min-h-full">
        {{ $slot }}
    </div>
</div>