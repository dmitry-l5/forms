<a {{ $attributes->merge(['class'=>'border border-2 rounded border-gray-500 px-3 py-1 hover:bg-gray-500 hover:border-gray-900 hover:text-zinc-100', 'href'=>'#']) }}>
    +{{ $slot }}
</a>