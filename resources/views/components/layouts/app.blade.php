<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Формы' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" text-lg">
    <section>
        <div class="w-full bg-green-700">
            {{ $header ?? 'oppa' }}
        </div>
    </section>
    <div class="">
        <section>

        </section>
        <main>
            {{ $slot }}
        </main>
        <section>

        </section>
    </div>
    <footer>

    </footer>
</body>
</html>
