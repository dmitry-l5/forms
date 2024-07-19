@props(['title', 'description'])
<div x-data="{ title:'{{$title}}',description:{{ json_encode($description) }} }"
x-init="console.log(description)">
    <h3 class="text-center text-2xl py-8 border-b border-black" x-text="title"></h3>
    <div x-text="description" class="py-5"></div>
    <div class=" min-h-full px-10 pb-5">
        {{ $slot }}
    </div>
</div>
