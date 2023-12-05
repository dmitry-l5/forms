<div class="border border-1 border-neutral-400 bg-white my-4 py-2 rounded-lg">
    <div class=" text-start px-4 border-b border-neutral-300" title="{{ $description ?? '' }}">
        {{ $title }}
    </div>
    <div class="">
        {{ $slot }}
    </div>
</div>