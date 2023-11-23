<div {{ $attributes->merge(['class'=>'border border-black m-1']) }}>
    <div>
        {{ $slot }}
    </div>
    <div>
        {{ $control ?? '' }}
    </div>
</div>