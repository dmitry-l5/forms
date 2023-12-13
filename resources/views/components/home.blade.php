<div {{ $attributes->merge(['class'=>"hover:bg-sky-500 border-black flex justify-center items-center px-4 py-2"]) }} class="">
    <a href="{{ url('/') }}">
        <img src="{{ asset('images/house.svg') }}" alt="" width="25px" class="filter-svg inline-block">
        @if (isset($title) && !empty($title))
            <div class="inline-block ml-5 text-white" >{{ $title ?? '' }}</div>
        @endif
    </a>
</div>