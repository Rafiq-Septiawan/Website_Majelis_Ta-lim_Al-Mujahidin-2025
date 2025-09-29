<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white h-screen p-4">
            <h2 class="text-xl font-bold mb-4">Admin Menu</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.santri') }}">Data Santri</a></li>
                <li><a href="{{ route('admin.laporan') }}">Laporan</a></li>
                <li><a href="{{ route('admin.profil') }}">Profil</a></li>
            </ul>
        </aside>

        {{-- Konten Halaman --}}
        <main class="flex-1 p-6">
            @yield('content')
            
        </main>
    </div>

</body>
</html>
