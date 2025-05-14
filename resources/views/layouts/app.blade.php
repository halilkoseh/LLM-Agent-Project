<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LLM Platform')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon1.png') }}">
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

<body class="flex flex-col min-h-screen bg-gray-50">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 border-b border-gray-200 glass-effect">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/dashboard" class="flex items-center space-x-3">
                        <div class="p-2 text-white bg-blue-700 rounded-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg font-semibold text-gray-800">LLM Platform</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="items-center hidden space-x-1 md:flex">
                    <a href="/dashboard"
                        class="px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded hover:bg-gray-100">
                        Ana Sayfa
                    </a>

                    <a href="/chat"
                        class="px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded hover:bg-gray-100">
                        Sohbet
                    </a>

                    <a href="/history"
                        class="px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded hover:bg-gray-100">
                        Ajan
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center px-3 py-2 space-x-2 text-sm font-medium transition-all duration-200 rounded hover:bg-gray-100">
                            <div
                                class="flex items-center justify-center text-xs text-white bg-blue-700 rounded-full w-7 h-7">
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
                            class="absolute right-0 w-48 py-1 mt-2 bg-white border border-gray-200 rounded-md shadow-md">
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil
                            </a>
                            <a href="/comments" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Değerlendirme
                            </a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                    Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenu = !mobileMenu"
                        class="p-2 text-gray-600 transition-all duration-200 rounded hover:bg-gray-100">
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
    <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-white border-t border-gray-200">
        <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    © 2025 LLM Platform. Tüm hakları saklıdır.
                </div>
                <div class="flex space-x-8">
                    <a href="/about" class="text-sm text-gray-600 transition-colors hover:text-blue-700">Hakkında</a>
                    <a href="/privacy" class="text-sm text-gray-600 transition-colors hover:text-blue-700">Gizlilik</a>
                    <a href="/contact" class="text-sm text-gray-600 transition-colors hover:text-blue-700">İletişim</a>
                </div>
            </div>

            <!-- Newsletter Subscription Section -->
            <div class="mt-8 text-center">

            </div>

            <!-- Social Media Links Section -->
            <div class="grid grid-cols-1 gap-8 mt-16 lg:grid-cols-2 lg:gap-32">
                <div class="max-w-sm mx-auto lg:max-w-none">
                    <p class="mt-4 text-center text-gray-500 lg:text-left lg:text-lg">
                        LLM Ajanları ile Yapay Zekâ Tabanlı Yazılım Geliştirme Platformu. En gelişmiş dil modelleri ile
                        kod analizi, sohbet ve otomatik kod yürütme özelliklerini tek bir yerde sunuyoruz.
                    </p>

                    <div class="flex justify-center gap-4 mt-6 lg:justify-start">




                        <a class="text-gray-700 transition hover:text-blue-700"
                            href="https://www.linkedin.com/in/halilkoseh/" target="_blank" rel="noreferrer">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.454C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z" />
                            </svg>
                        </a>

                        <a class="text-gray-700 transition hover:text-black" href="https://medium.com/@aitchkayedek"
                            target="_blank" rel="noreferrer">
                            <span class="sr-only">Medium</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M13.54 12a6.8 6.8 0 01-6.77 6.82A6.8 6.8 0 010 12a6.8 6.8 0 016.77-6.82A6.8 6.8 0 0113.54 12zM20.96 12c0 3.54-1.51 6.42-3.38 6.42-1.87 0-3.39-2.88-3.39-6.42s1.52-6.42 3.39-6.42 3.38 2.88 3.38 6.42M24 12c0 3.17-.53 5.75-1.19 5.75-.66 0-1.19-2.58-1.19-5.75s.53-5.75 1.19-5.75C23.47 6.25 24 8.83 24 12z" />
                            </svg>
                        </a>

                        <a class="text-gray-700 transition hover:text-gray-900" href="https://github.com/halilkoseh"
                            target="_blank" rel="noreferrer">
                            <span class="sr-only">GitHub</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a class="text-gray-700 transition hover:text-orange-500"
                            href="https://stackoverflow.com/users/23088015/halil-k%c3%b6se" target="_blank"
                            rel="noreferrer">
                            <span class="sr-only">Stack Overflow</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M15.725 0l-1.72 1.277 6.39 8.588 1.716-1.277L15.725 0zm-3.94 3.418l-1.369 1.644 8.225 6.85 1.369-1.644-8.225-6.85zm-3.15 4.465l-.905 1.94 9.702 4.517.904-1.94-9.701-4.517zm-1.85 4.86l-.44 2.093 10.473 2.201.44-2.092-10.473-2.203zM1.89 15.47V24h19.19v-8.53h-2.133v6.397H4.021v-6.396H1.89zm4.265 2.133v2.13h10.66v-2.13h-10.66z" />
                            </svg>
                        </a>

                        <a class="text-gray-700 transition hover:text-red-600"
                            href="https://www.youtube.com/@dualcoreprocessor185" target="_blank" rel="noreferrer">
                            <span class="sr-only">YouTube</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a class="text-gray-700 transition hover:text-green-600"
                            href="https://api.whatsapp.com/send/?phone=905382004466&text&type=phone_number&app_absent=0"
                            target="_blank" rel="noreferrer">
                            <span class="sr-only">WhatsApp</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M17.415 14.382c-.298-.149-1.759-.867-2.031-.967-.272-.099-.47-.148-.669.15-.198.296-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.668-1.612-.916-2.207-.241-.579-.486-.5-.668-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.064 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.57-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                    <div>
                        <p class="font-medium text-gray-900">Platformumuz</p>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="/dashboard" class="text-gray-700 transition hover:text-blue-700">Ana
                                    Sayfa</a></li>
                            <li><a href="/chat" class="text-gray-700 transition hover:text-blue-700">Sohbet</a></li>
                            <li><a href="/history" class="text-gray-700 transition hover:text-blue-700">Ajan</a></li>
                            <li><a href="/comments"
                                    class="text-gray-700 transition hover:text-blue-700">Değerlendirme</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Diğer</p>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="/contact" class="text-gray-700 transition hover:text-blue-700">Destek</a>
                            </li>
                            <li><a href="/about" class="text-gray-700 transition hover:text-blue-700">Hakkımızda</a>
                            </li>
                            <li><a href="/privacy" class="text-gray-700 transition hover:text-blue-700">Gizlilik
                                    Politikası</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>
