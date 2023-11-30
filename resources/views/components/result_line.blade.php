<div {{ $attributes }}>
    {{ $slot }}
    <div class=" bg-lime-400 flex justify-between" >
        <div class="" x-text='title'></div>
        <div class="flex">
            <div class=""><span x-text="count"></span><span>/</span><span x-text="total"></span></div>
            <div class="">; </div>
            <div class="">( {{ floor($percent) }}%)</div>
        </div>
    </div>
    <div class=" bg-slate-500 h-10 relative w-full ">
        <div class="bg-orange-600 h-10 absolute " style='width:{{ $percent ?? 0 }}%'>
        </div>
    </div>
</div>