@props(['title', 'description'])
<div >
    <div>string</div>
    {{ $title }}
    <h3 x-text="title"></h3>
    <div x-text="description"></div>
    <input type="text" name="$item->input_name" id="$item->input_name">
</div>