<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    {{-- Only for setting --}}
    @vite(['resources/js/app.js'])
</head>

<body>
    @php
        $appName = env('APP_NAME', 'oOo');
    @endphp

    <h2>Envoi d'un email sur mon beau site intitulé: <span style="color:blue">{{ $appName }}</span></h2>
    <hr>
    Des infos: {{ ucfirst($key777) }}
    <hr>
    Et: {{ $data }}
</body>

</html>
