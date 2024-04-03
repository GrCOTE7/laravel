<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | @php echo env('APP_NAME', 'oOo'); @endphp</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <script src="https://cdn.jsdelivr.net/npm/puppeteer@2.1.1"></script> --}}
    @vite([
        './resources/css/app.scss',
        // './public/assets/css/semantic.min.css',
        // './public/assets/js/jquery363.min.js',
        // './public/assets/js/semantic.min.js',
        'resources/js/app.js',
    ])
    @yield('css')
    @yield('prescripts')
</head>

<body>
    <nav>
        @include('partials.nav')
    </nav>
    <hr>

    <main>

        <x-notification />

        @yield('main')
        {{ $slot ?? null }}
    </main>

    <hr>

    @include('partials/footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
