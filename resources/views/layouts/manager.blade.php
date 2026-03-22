<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manager">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manager')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 antialiased">
    
    @include('layouts.manager-nav')

    {{-- Header --}}
    @isset($header)
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Main Content --}}
    <main class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{ $slot }}
        </div>
    </main>

    
    
</body>
</html>