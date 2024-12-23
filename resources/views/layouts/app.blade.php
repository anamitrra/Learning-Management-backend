@php
    $cwd = getcwd();
    $cssName = basename(glob($cwd . '/build/assets/*.css')[0], '.css');
    $jsName = basename(glob($cwd . '/build/assets/*.js')[0], '.js');
    $css = asset('build/assets/' . $cssName . '.css');
    $js = asset('build/assets/' . $jsName . '.js');
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

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="<?php echo $css; ?>" id="css">
    <script src='<?php echo $js; ?>'  id="js"></script>

    
    <!-- Scripts -->
     <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100  grid grid-cols-5">
        @include('layouts.sidebar')

        <div class="col-span-4">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
            <header class="bg-white shadow sticky top-0">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>