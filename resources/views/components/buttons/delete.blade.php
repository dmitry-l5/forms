<button {{ $attributes->merge(['type'=>'submit', 'class'=>'px-4 py-2 border bg-red-600 font-bold text-white hover:bg-red-400']) }}>
    {{ $slot }}
</button>
