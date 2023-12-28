
<div class="border border-1 border-sky-700 bg-white my-4 py-2 pt-0">
    <div class=" bg-sky-100 text-start px-4 border-b border-neutral-300 text-black font-semibold " title="{{ $description ?? '' }}">
        {{ $title }}
    </div>
    <div class="">
        {{ $slot }}
    </div>
</div>