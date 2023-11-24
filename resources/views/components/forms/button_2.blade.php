<button {{ $attributes->merge(["class"=>"border border-black m-1 px-1 py-3 hover:bg-zinc-300"]) }}>
    {{ $slot }}
</button>