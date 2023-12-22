@props(['title', 'name', 'description'])
<div class="">
    <label class="ps-2 font-medium" for="{{ $title }}">{{ $title }}</label>
    <textarea name="{{$name}}" id="{{ $title }}" cols="30" rows="10" class="w-full"></textarea>
    {{ $slot ?? '#' }}
</div>