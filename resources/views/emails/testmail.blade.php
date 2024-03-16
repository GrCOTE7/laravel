<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
    @php
        $appName = env('APP_NAME', 'oOo');
    @endphp

    <h2>Envoi d'un email sur mon beau site intitulé: {{ $appName }}</h2>
    <hr>
    {{  ucfirst($key777) }}
</body>

</html>
