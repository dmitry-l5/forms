<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Формы' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="text-lg w-full ">
    <div class="min-h-[100vh] flex flex-col justify-between w-auto">
        <div class="w-full">
            <div class="min-h-[48px] bg-sky-800 border-b-2 border-black text-zinc-700  flex justify-between items-center  ">
                @auth
                    <x-home title=""></x-home>  
                    <livewire:layout.auth_panel />
                @endauth
            </div>
            <div class="">
                {{ $header ?? '' }}
            </div>
        </div>
        <div class=" flex-grow flex flex-row overflow-x-auto">
            <section>
            </section>
            <main class="flex-grow">
                {{ $slot }}
            </main>
            <section>
                
            </section>
        </div>
        <div class="w-full text-white bg-sky-800 border-b-2  ">
            <div class="min-h-[48px] border-t-2 border-black">

            </div>
            <div class="">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
