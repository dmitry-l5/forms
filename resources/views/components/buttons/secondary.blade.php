<button {{ $attributes->merge(['class'=>'bg-zinc-500 px-4 py-2 text-white font-bold hover:bg-zinc-400']) }} >
    {{ $slot }}
</button>