<div class="">
    <label for="{{ $title }}">{{ $text }}</label>
    <input type="checkbox" name="{{$name}}[{{ $title }}]" id="{{ $title }}">
    {{ $slot ?? '#' }}
</div>