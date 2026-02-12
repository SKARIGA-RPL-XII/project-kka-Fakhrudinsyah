<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- NAVBAR PEMBIMBING --}}
    <x-navbar-pembimbing />

    {{-- KONTEN --}}
    <main class="flex-grow p-6">
        @yield('content')
    </main>

    {{-- FOOTER SISWA (DIPAKAI DI PEMBIMBING) --}}
    <x-footer-siswa />

</body>
</html>
