<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Формы' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-lg min-h-full text-neutral-800 bg-sky-50 ">
    <div class="min-h-[100vh] flex flex-col justify-between">
        <div class="w-full box-border">
            <div class="min-h-[48px] bg-sky-800 border-b-2 border-black flex justify-between items-end ">
                <x-home class="" title=""></x-home>
                <livewire:layout.auth_panel/>
            </div>
            <div class="">
                {{ $header ?? '' }}
            </div>
        </div>
        <div class=" flex-grow flex flex-roц justify-center">
            <section>

            </section>
            <main class="flex-grow max-w-7xl">
                <div>
                    {{ $slot }}
                </div>
            </main>
            <section>

            </section>
        </div>
        <div class="w-full  bg-sky-800  ">
            <div class="min-h-[48px] border-t-2 border-black">

            </div>
            <div class="">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</body>
</html>
