<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing PS</title>
    <!-- Memanggil CSS dari Vite (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">
        @php
            $setting = \App\Models\Setting::first();
        @endphp
        <h1 class="text-3xl font-bold text-center mb-8">Dashboard Kasir {{ $setting->rental_name ?? 'Billing PS' }}</h1>
        
        <!-- Memanggil Komponen Livewire -->
        <livewire:cashier-dashboard />
        
    </div>

    @livewireScripts
</body>
</html>
