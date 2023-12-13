<button {{ $attributes->merge(['type'=>'submit', 'class'=>'px-4 py-2 border bg-green-900 font-bold text-white hover:bg-green-800']) }}>
    {{ $slot }}
</button>