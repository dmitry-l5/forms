@props(['title','description'])
<div {{ $attributes->merge(['class'=>'']) }}>
    <div class='text-center text-2xl py-8 border-b border-black '>
        {{$title ?? ''}}
    </div>
    <div class="py-12">
        {{$description ?? ''}}
    </div>
</div>