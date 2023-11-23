@props(['name', 'title'])
<div class="">
    <label for="{{ $title }}">{{ $title }}</label>
    <input type="checkbox" name="{{$name}}[{{ $title }}]" id="{{ $title }}">
    {{ $slot ?? '#' }}
</div>