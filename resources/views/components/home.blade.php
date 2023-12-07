<div class=" bg-slate-100 p-3 m-3  border border-black">
    <a href="{{ url('/') }}">
        <img src="{{ asset('images/house.svg') }}" alt="" width="25px" class=" inline-block">
        <div class="inline-block ml-5" >{{ $title ?? __('Home page') }}</div>
    </a>
</div>