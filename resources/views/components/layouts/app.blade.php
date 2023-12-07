<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Формы' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-lg min-h-full">
    <div class="min-h-[100vh] flex flex-col justify-between">
        <div class="w-full">
            <div class="min-h-[48px] bg-green-600 border-b-2 border-black text-zinc-700 flex justify-between items-center "> 
                <x-home title="{{ __('Home page') }}"></x-home>  
                <livewire:layout.auth_panel />
            </div>
            <div class="">
                {{ $header ?? '' }}
            </div>
        </div>
        <div class=" flex-grow flex flex-row">
            <section>
    
            </section>
            <main class="flex-grow">
                {{ $slot }}
            </main>
            <section>
                
            </section>
        </div>
        <div class="w-full bg-green-600  ">
            <div class="min-h-[48px] border-t-2 border-black">

            </div>
            <div class="">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</body>
</html>