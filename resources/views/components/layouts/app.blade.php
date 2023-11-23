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
        <div class="w-full  bg-green-700">
            {{ $header ?? 'header' }}
            
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
        <div class="w-full bg-green-700 h-full">
            {{ $footer ?? 'footer' }}
        </div>
    </div>
</body>
</html>
