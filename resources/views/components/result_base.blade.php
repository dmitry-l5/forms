<div class="border border-2 border-sky-700 bg-white my-4 py-2 pt-0">
    <div class=" bg-sky-700 text-start px-4 border-b border-neutral-300 text-white " title="{{ $description ?? '' }}">
        {{ $title }}
    </div>
    <div class="">
        {{ $slot }}
    </div>
</div>