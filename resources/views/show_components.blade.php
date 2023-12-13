<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="flex">

    <div>
    <div class="border p-5">
        <h3>Цвета</h3>
        <div>zinc</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-lime-950">950</x-square>
            <x-square class=" !bg-lime-900">900</x-square>
            <x-square class=" !bg-lime-700">700</x-square>
            <x-square class=" !bg-lime-500">500</x-square>
            <x-square class=" !bg-lime-300">300</x-square>
            <x-square class=" !bg-lime-100">100</x-square>
        </div>
        <div>zinc</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-zinc-950">950</x-square>
            <x-square class=" !bg-zinc-900">900</x-square>
            <x-square class=" !bg-zinc-700">700</x-square>
            <x-square class=" !bg-zinc-500">500</x-square>
            <x-square class=" !bg-zinc-300">300</x-square>
            <x-square class=" !bg-zinc-100">100</x-square>
        </div>
        <div>sky</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-sky-950">950</x-square>
            <x-square class=" !bg-sky-900">900</x-square>
            <x-square class=" !bg-sky-700">700</x-square>
            <x-square class=" !bg-sky-500">500</x-square>
            <x-square class=" !bg-sky-300">300</x-square>
            <x-square class=" !bg-sky-100">100</x-square>
        </div>
        <div>yellow</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-yellow-950">950</x-square>
            <x-square class=" !bg-yellow-900">900</x-square>
            <x-square class=" !bg-yellow-700">700</x-square>
            <x-square class=" !bg-yellow-500">500</x-square>
            <x-square class=" !bg-yellow-300">300</x-square>
            <x-square class=" !bg-yellow-100">100</x-square>
        </div>
        <div>orange</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-orange-950">950</x-square>
            <x-square class=" !bg-orange-900">900</x-square>
            <x-square class=" !bg-orange-700">700</x-square>
            <x-square class=" !bg-orange-500">500</x-square>
            <x-square class=" !bg-orange-300">300</x-square>
            <x-square class=" !bg-orange-100">100</x-square>
        </div>
        <div>neutral</div>
        <div class=' flex flex-row'>
            <x-square class=" !bg-neutral-950">950</x-square>
            <x-square class=" !bg-neutral-900">900</x-square>
            <x-square class=" !bg-neutral-700">700</x-square>
            <x-square class=" !bg-neutral-500">500</x-square>
            <x-square class=" !bg-neutral-300">300</x-square>
            <x-square class=" !bg-neutral-100">100</x-square>
        </div>
    </div>
    </div>
    <div>
    <div class="border p-5">
        <h3>Кнопки</h3>
        <div class="border p-5">
            <x-buttons.primary>buttons.primary</x-buttons.primary>
            <x-buttons.secondary>buttons.secondary</x-buttons.secondary>
            <x-buttons.success>buttons.success</x-buttons.success>
            <x-buttons.link>buttons.link</x-buttons.link>

        </div>
    </div>
    </div>
    </div>
    
    @livewireScripts
</body>
</html>