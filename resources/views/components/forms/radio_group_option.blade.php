@props(['input_name', 'name', 'title'])
<div class="">
    <label for="{{ $title }}">{{ $title }}</label>
    <input type="radio" name="{{$input_name}}" value="{{ $name }}" id="{{ $title }}" required>
    {{ $slot ?? '#' }}
</div>