@props(['title', 'name', 'description'])
<div class="">
    <label for="{{ $title }}">{{ $title }}</label>
    <input type="checkbox" name="{{$name}}" id="{{ $title }}">
    {{ $slot ?? '#' }}
</div>