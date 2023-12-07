<div {{ $attributes->merge(['class'=>'']) }}>
    <div class=" flex justify-between pl-10" >
        <div class="" x-text='title'></div>
        <div class="flex">
            <div class=""><span x-text="count"></span><span>/</span><span x-text="total"></span></div>
            <div class="">; </div>
            <div class="">( {{ floor($percent) }}%)</div>
        </div>
    </div>
    <div class="border shadow0 shadow-neutral-500">
        <div class=" bg-lime-200 h-[5px] relative w-full ">
            <div class="bg-green-600 h-[5px] absolute " style='width:{{ $percent ?? 0 }}%'>
            </div>
        </div>
    </div>
    {{ $slot }}
</div>