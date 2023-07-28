<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>@yield('RestaurantQr')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Add the Tailwind CSS stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
<nav class="bg-white py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="/" class="text-lg font-semibold text-gray-900">Laravel Application</a>

        <div>
            <a href="{{ route('categories.index') }}" class="text-gray-900 hover:text-gray-700 px-2">Categories</a>
            <a href="{{ route('products.index') }}" class="text-gray-900 hover:text-gray-700 px-2">Products</a>
        </div>
    </div>
</nav>

<main class="py-8">
    @yield('content')
</main>

<footer class="bg-white py-4 mt-12">
    <div class="container mx-auto px-4 text-center text-gray-600">
        &copy; {{ date('Y') }} RestaurantQr Application. All rights reserved.
    </div>
</footer>

<!-- Add the Tailwind CSS purged file -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
