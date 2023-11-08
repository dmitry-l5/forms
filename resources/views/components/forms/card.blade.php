<div {{ $attributes->merge(['class'=>'border border-black my-1']) }}>
    <div class="">
        {{ $title ?? '' }}
    </div>
    <div class="">
        {{ $description ?? ''}}
    </div>
    <div class="">
        {{ $inputs ?? '' }}
    </div>

</div>