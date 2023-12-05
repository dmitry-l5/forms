<div {{ $attributes->merge(['class'=>'  h-full border border-slate-400 p-4 flex flex-col justify-stretch  rounded-2xl']) }}>
    <div class=" h-full ">
        {{ $slot }}
    </div>
    <div class=" mt-auto  text-right">
        {{ $counter }}
    </div>
    <div class="m-auto text-center">
        {{ $control ?? '' }}
    </div>
</div>