<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BookNest') | BookNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('extra_css')
</head>
<body class="@yield('body_class')">
    @unless (View::hasSection('guest'))
        <x-navbar :username="$username ?? ''" :active="trim($__env->yieldContent('active'))" />
    @endunless

    <main class="main">
        @include('partials.flash')
        @yield('content')
    </main>

    @unless (View::hasSection('guest'))
        <x-footer />
    @endunless

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extra_js')
</body>
</html>
