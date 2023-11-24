@props(['input_name', 'name', 'title'])
<div class="">
    <label for="{{ $title }}">{{ $title }}</label>
    <input type="checkbox" name="{{$input_name}}[{{ $name }}]" id="{{ $title }}">
    {{ $slot ?? '#' }}
</div>