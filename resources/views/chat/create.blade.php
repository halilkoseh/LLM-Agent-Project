@extends('layouts.app')

@section('title', 'Yeni Sohbet')

@section('content')

<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-semibold mb-3 text-gray-800">
                Yeni Sohbet Başlatın
            </h2>
            <p class="text-gray-600 max-w-xl mx-auto text-sm">
                Yapay zeka modellerimizle desteklenen sohbetinizi yapılandırabilirsiniz.
            </p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-lg shadow border border-gray-100 p-6">
            <!-- Info Cards -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 p-3 rounded-md border border-blue-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <h3 class="font-medium text-sm text-gray-800">Hızlı Yanıt</h3>
                    </div>
                    <p class="text-xs text-gray-600 mt-1">Saniyeler içinde yanıt alın</p>
                </div>

                <div class="bg-blue-50 p-3 rounded-md border border-blue-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="font-medium text-sm text-gray-800">Güvenli</h3>
                    </div>
                    <p class="text-xs text-gray-600 mt-1">Şifreli iletişim</p>
                </div>

                <div class="bg-blue-50 p-3 rounded-md border border-blue-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="font-medium text-sm text-gray-800">Çoklu Model</h3>
                    </div>
                    <p class="text-xs text-gray-600 mt-1">Karşılaştırmalı sonuçlar</p>
                </div>
            </div>

            <form id="startChatForm" action="{{ route('chat.start') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Başlık Alanı -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Sohbet Başlığı
                        <span class="text-gray-400 text-xs ml-1">(Opsiyonel)</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        placeholder="Sohbet başlığını giriniz"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-all outline-none text-sm"
                        maxlength="100"
                    >
                </div>

                <!-- Model Seçimi -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Model Seçimi (Birden fazla seçilebilir.)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- GPT-4 Turbo Card -->
                        <label class="relative block">
                            <input type="checkbox" name="models[]" value="openai" class="peer hidden">
                            <div class="p-4 rounded-md border border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all cursor-pointer">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <h3 class="font-medium text-gray-900 text-sm">GPT-4 Turbo</h3>
                                        <p class="text-xs text-gray-500">OpenAI</p>
                                    </div>
                                    <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-blue-100 text-blue-700">
                                        Önerilen
                                    </span>
                                </div>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Yüksek doğruluk oranı
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Geniş bilgi tabanı
                                    </li>
                                    <li class="flex items-center text-gray-500">
                                        <svg class="w-3 h-3 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Yüksek işlem maliyeti
                                    </li>
                                </ul>
                            </div>
                        </label>

                        <!-- Gemini Card -->
                        <label class="relative block">
                            <input type="checkbox" name="models[]" value="gemini" class="peer hidden">
                            <div class="p-4 rounded-md border border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all cursor-pointer">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <h3 class="font-medium text-gray-900 text-sm">Gemini 2.0</h3>
                                        <p class="text-xs text-gray-500">Google AI</p>
                                    </div>
                                    <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-blue-100 text-blue-700">
                                        Yeni
                                    </span>
                                </div>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Görsel analiz yeteneği
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Düşük maliyet
                                    </li>
                                    <li class="flex items-center text-gray-500">
                                        <svg class="w-3 h-3 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Sınırlı dil desteği
                                    </li>
                                </ul>
                            </div>
                        </label>
                    </div>
                    <p id="modelError" class="text-red-500 text-xs hidden mt-1">Lütfen en az bir model seçin</p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-all flex items-center justify-center space-x-2"
                >
                    <span>Sohbeti Başlat</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('startChatForm').addEventListener('submit', function(event) {
    const checkedModels = document.querySelectorAll('input[name="models[]"]:checked');
    const errorElement = document.getElementById('modelError');

    if (checkedModels.length === 0) {
        event.preventDefault();
        errorElement.classList.remove('hidden');
        setTimeout(() => errorElement.classList.add('hidden'), 3000);
    } else {
        errorElement.classList.add('hidden');
    }
});
</script>

@endsection
