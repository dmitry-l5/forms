@props(['input_name', 'name', 'title', 'index'])
<div class="">
    <input type="radio" name="{{$input_name}}" value="{{ $name }}" id="{{$input_name.'_'.$name}}" required>
    <label for="{{$input_name.'_'.$name}}">{{ $title }}</label>
</div>
