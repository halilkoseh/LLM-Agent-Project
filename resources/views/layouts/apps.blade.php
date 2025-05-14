<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LLM Platform')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class=" bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="glass-effect border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/dashboard" class="flex items-center space-x-3">
                        <div class="p-2 rounded-md bg-blue-700 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg font-semibold text-gray-800">LLM Platform</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/dashboard"
                        class="px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition-all duration-200 text-sm font-medium">
                        Ana Sayfa
                    </a>

                    <a href="/chat"
                        class="px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition-all duration-200 text-sm font-medium">
                        Sohbet
                    </a>

                    <a href="/history"
                        class="px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition-all duration-200 text-sm font-medium">
                        Ajan
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-100 transition-all duration-200 text-sm font-medium">
                            <div class="w-7 h-7 rounded-full bg-blue-700 flex items-center justify-center text-white text-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700">Profil</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-md py-1 border border-gray-200">
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil
                            </a>
                            <a href="/comments" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Değerlendirme
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenu = !mobileMenu"
                        class="p-2 rounded text-gray-600 hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->


</body>

</html>
