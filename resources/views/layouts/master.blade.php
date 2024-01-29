<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga45 - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts-head')
</head>

<body class="min-h-screen">
    
    @include('layouts.navbar')
    
    <article class="pt-24 px-6 lg:px-16 mx-auto">
        @yield('content')
        
    </article>

    <script src="/plugins/jquery/jquery.min.js"></script>
    @stack('scripts-body')
</body>

</html>
