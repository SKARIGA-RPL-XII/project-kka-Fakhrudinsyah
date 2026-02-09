<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Siswa')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

    {{-- NAVBAR COMPONENT --}}
    <x-navbar-siswa />

    {{-- CONTENT --}}
    <main class="pt-16">
    @yield('content')
</main>


    <x-footer-siswa />

</body>
</html>
