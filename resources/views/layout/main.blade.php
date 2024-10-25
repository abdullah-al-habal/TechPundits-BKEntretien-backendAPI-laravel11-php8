@php
$cwd = getcwd();
$cssFiles = glob($cwd . '/build/assets/*.css');
$jsFiles = glob($cwd . '/build/assets/*.js');
$cssName = !empty($cssFiles) ? basename($cssFiles[0], '.css') : null;
$jsName = !empty($jsFiles) ? basename($jsFiles[0], '.js') : null;
$css = $cssName ? asset('build/assets/' . $cssName . '.css') : null;
$js = $jsName ? asset('build/assets/' . $jsName . '.js') : null;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @if($css)
    <link rel="stylesheet" href="{{ $css }}" id="css">
    @endif

    {{-- Commented out Vite directive --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    @if($js)
    <script src="{{ $js }}" id="js"></script>
    @endif
</body>

</html>