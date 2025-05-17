<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verify Email - LLM Agents Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        },
                    },
                },
            },
        }
    </script>
    <style>
        .bg-gradient-custom {
            background: linear-gradient(135deg, #0369a1 0%, #312e81 100%);
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #0284c7, #3730a3, #0c4a6e, #4338ca);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .language-tab {
            transition: all 0.3s ease;
        }

        .language-tab:hover {
            transform: translateY(-2px);
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 animated-gradient md:p-6 lg:p-8">
    <div class="flex flex-col w-full max-w-6xl overflow-hidden bg-white shadow-2xl rounded-2xl lg:flex-row">
        <!-- Project Information Section -->
        <div class="relative p-8 overflow-hidden text-white lg:w-1/2 lg:p-12 bg-gradient-custom">
            <!-- Animated Background Particles -->
            <div class="absolute inset-0 opacity-10">
                <div id="particles-js"></div>
            </div>

            <div class="relative z-10 flex flex-col justify-between h-full">
                <div>
                    <!-- Language Selector -->
                    <div class="flex mb-6 space-x-2 text-sm">
                        <button id="btn-tr" class="px-3 py-1 font-medium bg-white rounded-full language-tab bg-opacity-20">Türkçe</button>
                        <button id="btn-en" class="px-3 py-1 bg-white rounded-full language-tab bg-opacity-10">English</button>
                    </div>

                    <!-- Turkish Content -->
                    <div id="content-tr" class="language-content">
                        <h1 class="mb-4 text-3xl font-bold md:text-4xl">LLM Ajanları ile Yapay Zekâ Tabanlı Etkileşimli Yazılım Geliştirme Platformu</h1>
                        <p class="mb-8 text-lg opacity-90">Bu çalışmada, büyük dil modeli (LLM) ajanlarını kullanarak en az 3 programlama dilini destekleyecek şekilde birim testleri (unit test), arayüz testleri ve girdi olarak verilen kodun yorumlamasını yapabilecek bir platform geliştirilmesi amaçlanmaktadır.</p>

                        <div class="mb-12 space-y-4">
                            <div class="flex items-start space-x-3">
                            </div>
                        </div>
                    </div>

                    <!-- English Content -->
                    <div id="content-en" class="hidden language-content">
                        <h1 class="mb-4 text-3xl font-bold md:text-4xl">LLM Agent-Based AI Interactive Software Development Platform</h1>
                        <p class="mb-8 text-lg opacity-90">This project aims to develop a platform using large language model (LLM) agents to support at least 3 programming languages for unit testing, interface testing, and code interpretation.</p>

                        <div class="mb-12 space-y-4">
                            <div class="flex items-start space-x-3">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Credits -->
                <div class="pt-6 mt-auto border-t border-white border-opacity-20">
                    <div class="flex flex-col items-start justify-between md:flex-row md:items-center">
                        <div>
                            <p class="text-sm opacity-90">Proje Sahibi / Project By:</p>
                            <p class="font-semibold">Halil Köse</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <p class="text-sm opacity-90">Danışman / Advisor:</p>
                            <p class="font-semibold">Doç. Dr. Jawad Rasheed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Verification Form Section -->
        <div class="p-8 lg:w-1/2 lg:p-12">
            <div class="flex flex-col h-full max-w-md mx-auto">
                <!-- Logo/Title -->
                <div class="mb-8 text-center">
                    <div class="flex justify-center">
                        <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-gradient-custom">
                            <i class="text-2xl text-white fas fa-envelope-open-text"></i>
                        </div>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold text-gray-800">Email Verification</h2>
                    <p class="text-sm text-gray-600">Please verify your email address to continue</p>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                <div class="p-4 mb-6 text-sm text-green-700 border border-green-300 rounded-lg bg-green-50">
                    <div class="flex">
                        <i class="mr-2 fas fa-check-circle"></i>
                        <span>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
                    </div>
                </div>
                @endif

                <!-- Verification Message -->
                <div class="p-4 mb-6 text-sm text-blue-700 border border-blue-300 rounded-lg bg-blue-50">
                    <div class="flex">
                        <i class="mr-2 fas fa-info-circle"></i>
                        <span>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</span>
                    </div>
                </div>

                <!-- Email Animation -->
                <div class="flex justify-center my-8">
                    <div class="relative">
                        <div class="w-24 h-16 mx-auto mb-4 border-2 border-gray-300 rounded-lg">
                            <div class="absolute w-4 h-4 bg-blue-500 rounded-full pulse top-2 right-2"></div>
                            <div class="flex items-center justify-center w-full h-full">
                                <i class="text-2xl text-gray-400 fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="w-16 h-1 mx-auto mb-1 bg-gray-300"></div>
                        <div class="w-10 h-1 mx-auto bg-gray-300"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                        @csrf
                        <button type="submit" class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition duration-150 border border-transparent rounded-md shadow-sm group bg-gradient-custom hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="text-white fas fa-paper-plane"></i>
                            </span>
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 transition duration-150 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>

                <!-- Additional Information (mobile-visible only) -->
                <div class="pt-6 mt-auto border-t border-gray-200 lg:hidden">
                    <div class="text-xs text-center text-gray-500">
                        <p>LLM Agent-Based AI Interactive Software Development Platform</p>
                        <p class="mt-1">© 2025 Halil Köse | All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: "none", random: true, straight: false, out_mode: "out", bounce: false, }
            },
            interactivity: {
                detect_on: "canvas",
                events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" }, },
            },
        });

        // Language Switcher
        document.getElementById('btn-tr').addEventListener('click', function() {
            document.getElementById('content-tr').classList.remove('hidden');
            document.getElementById('content-en').classList.add('hidden');
            document.getElementById('btn-tr').classList.add('bg-opacity-20');
            document.getElementById('btn-tr').classList.add('font-medium');
            document.getElementById('btn-en').classList.remove('bg-opacity-20');
            document.getElementById('btn-en').classList.remove('font-medium');
            document.getElementById('btn-en').classList.add('bg-opacity-10');
        });

        document.getElementById('btn-en').addEventListener('click', function() {
            document.getElementById('content-en').classList.remove('hidden');
            document.getElementById('content-tr').classList.add('hidden');
            document.getElementById('btn-en').classList.add('bg-opacity-20');
            document.getElementById('btn-en').classList.add('font-medium');
            document.getElementById('btn-tr').classList.remove('bg-opacity-20');
            document.getElementById('btn-tr').classList.remove('font-medium');
            document.getElementById('btn-tr').classList.add('bg-opacity-10');
        });
    </script>
</body>

</html>
