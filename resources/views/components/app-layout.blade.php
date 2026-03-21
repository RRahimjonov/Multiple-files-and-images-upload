@props([
    'title' => 'Image Upload',
    'subtitle' => null,
])

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <main class="page">
            <header class="header">
                <div>
                    <h1 class="title">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="subtitle">{{ $subtitle }}</p>
                    @endif
                </div>
                <div>
                    {{ $actions ?? '' }}
                </div>
            </header>

            {{ $slot }}
        </main>
    </body>
</html>
