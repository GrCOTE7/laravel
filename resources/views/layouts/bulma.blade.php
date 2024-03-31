<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | @php echo env('APP_NAME', 'oOo'); @endphp</title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        @if (session()->has('info'))
            <div class="notification is-success">
                {{ session('info') }}
            </div>
        @endif

        @yield('main')
    </main>

    <hr>

    @include('partials/footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
