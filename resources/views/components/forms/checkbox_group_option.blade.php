@props(['input_name', 'name', 'title'])
<div class="py-1">
    <input class="rounded  h-8 w-8 current checked:bg-green-500" type="checkbox" name="{{$input_name}}[{{ $name }}]" id="{{ $title }}" required>
    <label class=" ps-2 font-medium" for="{{ $title }}">{{ $title }}</label>
    {{ $slot ?? '#' }}
</div>