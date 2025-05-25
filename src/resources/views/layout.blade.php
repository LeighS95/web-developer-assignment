<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Database</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href={{ asset('index.css') }}>
</head>

<body>
    <header class="header">
        <a class="logo" href="/books">Book Database</a>
    </header>

    <main class="content">
        @yield('content')
    </main>

    <footer class="footer">
        <small>Book Database &copy; 2025</small>
    </footer>
</body>

</html>