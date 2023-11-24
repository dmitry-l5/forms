@props(['input_name', 'name', 'title'])
<div class="">
    <label for="{{ $title }}">{{ $title }}</label>
    <input type="radio" name="{{$input_name}}" id="{{ $title }}" value={{$name}}>
    {{ $slot ?? '#' }}
</div>