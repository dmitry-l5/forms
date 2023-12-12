<button {{ $attributes->merge(['type'=>'submit', 'class'=>'px-4 py-2 border bg-sky-950 font-bold text-white hover:bg-sky-800']) }}>
    {{ $slot }}
</button>