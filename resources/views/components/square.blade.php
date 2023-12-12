<div  class=" p-1">
    <div class="border border-zinc-950 flex flex-col">
        <div {{ $attributes->merge(['class'=>'w-28 h-28 bg-white']) }} class="bg-green-500"></div>
            <div class=" h-full w-28 text-center break-words ">
                {{ $slot }}
            </div>
    </div>
</div>