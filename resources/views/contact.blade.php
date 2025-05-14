@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">İletişim</h1>
            <p class="text-sm text-gray-600 mt-1">Sorularınız için bize ulaşabilirsiniz.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- İletişim Bilgileri -->
            <div class="col-span-1">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-5 h-full">
                    <h2 class="text-lg font-medium text-gray-800 mb-4">İletişim Bilgileri</h2>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Telefon</p>
                                <p class="text-sm text-gray-600">+90 538 200 44 66</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">E-posta</p>
                                <a href="mailto:halilulucak@icloud.com" class="text-sm text-blue-600 hover:underline">halilulucak@icloud.com</a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Adres</p>
                                <p class="text-sm text-gray-600">İstanbul Sabahattin Zaim Üniversitesi, Yazılım Mühendisliği, İstanbul, Türkiye</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- İletişim Formu -->
            <div class="col-span-2">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-5">
                    <h2 class="text-lg font-medium text-gray-800 mb-4">Bizimle İletişime Geçin</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        Herhangi bir sorunuz veya geri bildiriminiz varsa, aşağıdaki formu doldurarak bizimle iletişime geçebilirsiniz.
                    </p>

                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Konu</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mesaj</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"></textarea>
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                Gönder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Harita veya Şirket Bilgileri -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-5 mb-6">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Konum</h2>
            <div class="relative w-full rounded overflow-hidden" style="padding-bottom: 56.25%;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1504.8712078302133!2d28.781941505169137!3d41.03089104089756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa527998d3229%3A0xd29731c4ce3499de!2s%C4%B0stanbul%20Sabahattin%20Zaim%20%C3%9Cniversitesi%20K%C3%BCt%C3%BCphanesi!5e0!3m2!1str!2str!4v1745784211450!5m2!1str!2str"
                    class="absolute top-0 left-0 w-full h-full rounded border-0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="text-center mt-8">
        </div>
    </div>
@endsection
