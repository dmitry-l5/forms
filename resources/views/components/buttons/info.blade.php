<button {{ $attributes->merge(['type'=>'submit', 'class'=>'px-4 py-2 border bg-teal-600 font-bold text-teal-50 hover:bg-teal-500']) }}>
    {{ $slot }}
</button>
