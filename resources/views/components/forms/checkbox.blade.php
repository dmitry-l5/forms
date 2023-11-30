@props(['title', 'name', 'description'])
<div class="">
    <input class="rounded  h-8 w-8 current checked:bg-green-500" type="checkbox" name="{{$name}}" id="{{ $title }}">
    <label class=" ps-2 font-medium" for="{{ $title }}">{{ $title }}</label>
    {{ $slot ?? '#' }}
</div>