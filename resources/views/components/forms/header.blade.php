@props(['title','description'])
<div {{ $attributes->merge(['class'=>'border-b border-black']) }}>
    <div class='text-center text-2xl'>
        {{$title ?? ''}}
    </div>
    <div>
        {{$description ?? ''}}
    </div>
</div>