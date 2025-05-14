@extends('layouts.app')

@section('title', 'Hakkında - LLM Platformu')

@section('content')

<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Proje Kimlik Bilgileri -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">LLM Ajanları ile Yapay Zeka Destekli Etkileşimli Yazılım Geliştirme Platformu</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <table class="w-full text-sm">
                    <tbody>
                        <tr>
                            <td class="py-2 pr-4 font-medium text-gray-700 align-top">Proje Sahibi:</td>
                            <td class="py-2 text-gray-800">Halil KÖSE</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium text-gray-700 align-top">Danışman:</td>
                            <td class="py-2 text-gray-800">Doç. Dr. Jawad RASHEED</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="w-full text-sm">
                    <tbody>
                        <tr>
                            <td class="py-2 pr-4 font-medium text-gray-700 align-top">Mentör:</td>
                            <td class="py-2 text-gray-800">Orhan AKSOY (ASELSAN)</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium text-gray-700 align-top">Kurum:</td>
                            <td class="py-2 text-gray-800">İstanbul Sabahattin Zaim Üniversitesi - Yazılım Mühendisliği</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Problem Tanımı ve Amacı -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Problem Tanımı & Amacı</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Hızla büyüyen yazılım sektöründe, manuel testlerin sınırları ve kalite eksiklikleri nedeniyle daha verimli, hatasız, belgelenebilir yazılımlar geliştirilmesi ihtiyacı doğmuştur. Proje, büyük dil modeli ajanları kullanarak kod analizi, hata tespiti, dokümantasyon ve test otomasyonu süreçlerini desteklemektedir.
        </p>
    </section>

    <!-- Literature & Özgün Değerler -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Literatür Taraması & Projenin Özgünlüğü</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Yapay zeka ve LLM ajanlarının kod analizi alanındaki gelişimleri incelenmiştir. Projemiz, OpenAI GPT-4, Meta LLaMA ve Google Gemini gibi modelleri karşılaştırmalı kullanarak daha kapsamılı ve entegre bir yazılım destek sistemi sunmaktadır.
        </p>
    </section>

    <!-- Kullanılan Teknolojiler -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Kullanılan Teknolojiler</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-md font-medium text-gray-700 mb-2">Yazılım Geliştirme</h3>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">Backend:</span> PHP (Laravel 10), MySQL</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">Frontend:</span> Blade, Tailwind CSS, JavaScript</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">API Entegrasyon:</span> REST API, WebSockets</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-md font-medium text-gray-700 mb-2">Yapay Zeka & Altyapı</h3>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">LLM Modelleri:</span> OpenAI GPT-4, Google Gemini, Meta LLaMA</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">Sunucu:</span> Ubuntu Server, Nginx</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span><span class="font-medium">DevOps:</span> Git, GitHub CI/CD</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Proje Aşamaları (Timeline) -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Proje Aşamaları</h2>

        <div class="relative border-l-2 border-blue-600 ml-4 space-y-6">
            <div class="ml-6">
                <div class="flex items-center">
                    <div class="absolute -left-[9px] bg-white border-2 border-blue-600 rounded-full w-4 h-4"></div>
                    <h3 class="font-medium text-sm text-gray-800">Ocak 2025</h3>
                </div>
                <p class="text-sm text-gray-700 mt-1">Problem analizi, literatür taraması, kapsam belirleme.</p>
            </div>

            <div class="ml-6">
                <div class="flex items-center">
                    <div class="absolute -left-[9px] bg-white border-2 border-blue-600 rounded-full w-4 h-4"></div>
                    <h3 class="font-medium text-sm text-gray-800">Mart 2025</h3>
                </div>
                <p class="text-sm text-gray-700 mt-1">Metodoloji geliştirilmesi, LLM API entegrasyonları, İlk testler.</p>
            </div>

            <div class="ml-6">
                <div class="flex items-center">
                    <div class="absolute -left-[9px] bg-white border-2 border-blue-600 rounded-full w-4 h-4"></div>
                    <h3 class="font-medium text-sm text-gray-800">Haziran 2025</h3>
                </div>
                <p class="text-sm text-gray-700 mt-1">Sistem testi, performans değerlendirmesi, karşılaşılan zorluklar ve çözümler.</p>
            </div>
        </div>
    </section>

    <!-- İletişim -->
    <section class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">İletişim</h2>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <p class="text-sm text-gray-700">Sorularınız için: <a href="mailto:halilulucak@icloud.com" class="text-blue-600 hover:underline">halilulucak@icloud.com</a></p>
        </div>
    </section>

</div>

@endsection
