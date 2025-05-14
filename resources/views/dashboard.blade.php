@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
    <!-- Main Content -->
    <div class="flex-1 bg-gray-50">
        <div class="px-4 py-8 mx-auto space-y-6 max-w-7xl sm:px-6">

            <!-- Welcome & Overview Section -->
            <section
                class="relative p-6 overflow-hidden text-white shadow-lg bg-gradient-to-r from-blue-400 to-indigo-500 rounded-xl">
                <div class="absolute inset-0 bg-pattern opacity-10"></div>
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold">Hoşgeldiniz, {{ auth()->user()->name }}</h1>
                            <p class="mt-2 text-blue-100">LLM Ajanları ile Yapay Zekâ Tabanlı Yazılım Geliştirme Platformu
                            </p>
                        </div>
                        <div class="flex items-center mt-4 space-x-3 md:mt-0">
                            <span class="flex items-center px-3 py-1 text-sm rounded-full bg-blue-900/30">
                                <span class="w-2 h-2 mr-2 bg-green-400 rounded-full animate-pulse"></span>
                                <span>{{ auth()->user()->email }}</span>
                            </span>
                            <span id="clock" class="px-3 py-1 text-sm rounded-full bg-blue-900/30">--:--:--</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
                        <div class="flex items-center p-4 rounded-lg bg-white/10 backdrop-blur">
                            <div class="p-3 mr-4 bg-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-100">Toplam Ajan Kullanımı</p>
                                <p class="text-2xl font-bold">{{ $totalRequests }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 rounded-lg bg-white/10 backdrop-blur">
                            <div class="p-3 mr-4 bg-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-100">Toplam Değerlendirme</p>
                                <p class="text-2xl font-bold">{{ $totalFeedbacks }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 rounded-lg bg-white/10 backdrop-blur">
                            <div class="p-3 mr-4 bg-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-100">Son Aktivite</p>
                                <p class="text-lg font-bold">{{ $lastRequestDate ?? 'Hiç aktivite yok' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Analytics Section with Charts -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Activity Chart -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Toplam Ajan Kullanımı Analizi</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-xs text-blue-700 rounded-full bg-blue-50 chart-period-btn active"
                                data-period="7">7 Gün</button>
                            <button class="px-3 py-1 text-xs text-gray-700 bg-gray-100 rounded-full chart-period-btn"
                                data-period="30">30 Gün</button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                <!-- Performance Chart -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Mesaj İstatistikleri</h2>
                        <div class="relative">
                            <select id="chartMetricSelect"
                                class="px-3 py-1 pr-8 text-xs text-blue-700 rounded-full appearance-none bg-blue-50 focus:outline-none">
                                <option value="daily">Son 7 Gün</option>
                                <option value="monthly">Son 6 Ay</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-2 text-blue-700 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </section>

            <!-- Quick Actions -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Quick Question -->
                <div class="p-6 transition-all bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hızlı Soru Sor
                        </h2>
                    </div>
                    <form id="quickQuestionForm" class="space-y-3">
                        <div class="relative">
                            <textarea name="question" rows="4"
                                class="w-full p-4 text-sm transition-all border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Kısa bir soru yazınız..."></textarea>
                            <div class="absolute px-1 text-xs text-gray-400 bg-white right-3 bottom-3">
                                <span id="questionCharCount">0</span>/500
                            </div>
                        </div>
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-3 font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Sor ve Yanıt Al
                        </button>
                    </form>
                    <div id="quickAnswer" class="hidden mt-5 animate-fade-in">
                        <div class="p-4 border border-blue-100 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50">
                            <div class="flex items-center mb-2 space-x-2">
                                <span class="p-1 text-blue-700 bg-blue-100 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </span>
                                <span class="font-medium text-blue-800">AI Yanıtı</span>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-700" id="quickAnswerText"></p>
                        </div>
                    </div>
                </div>

                <!-- Code Runner -->
                <div class="p-6 transition-all bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            Kod Çalıştır
                        </h2>
                        <div class="flex space-x-2">
                            <select id="languageSelect"
                                class="px-3 py-1 text-xs text-gray-700 bg-gray-100 rounded-full focus:outline-none">
                                <option value="All">All with AI Compiler</option>
                                <option value="python">Python</option>
                                <option value="java">Java</option>
                                <option value="C/C++">C/C++</option>
                            </select>
                        </div>
                    </div>
                    <form id="codeRunForm" class="space-y-3">
                        <div class="relative overflow-hidden bg-gray-900 rounded-lg">
                            <div class="flex items-center justify-between px-4 py-2 text-xs text-gray-400 bg-gray-800">
                                <span id="selectedLanguage">Python</span>
                                <div class="flex space-x-1">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                </div>
                            </div>
                            <textarea name="code" rows="5"
                                class="w-full p-4 font-mono text-sm text-gray-200 bg-gray-900 focus:outline-none"
                                placeholder="Kodunuzu buraya yazınız..."></textarea>
                        </div>
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-3 font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Kodu Çalıştır
                        </button>
                    </form>
                    <div id="codeResult" class="hidden mt-5 animate-fade-in">
                        <div class="relative p-4 font-mono text-sm text-gray-200 bg-gray-800 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <span class="flex items-center text-xs font-medium text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Kod Çıktısı
                                </span>
                                <button id="copyOutput" class="text-xs text-gray-400 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="overflow-x-auto max-h-40 scrollbar-thin">
                                <p id="codeResultText" class="whitespace-pre-wrap"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Top Agents Card -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl">
                    <div class="p-6">
                        <h2 class="flex items-center mb-4 text-lg font-semibold text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Popüler Ajanlar
                        </h2>
                        <div class="space-y-3">
                            <div class="relative">
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="font-medium text-gray-700">GPT-4</span>
                                    <span class="text-blue-600">82%</span>
                                </div>
                                <div class="flex h-2 overflow-hidden text-xs bg-gray-100 rounded-full">
                                    <div style="width: 82%" class="bg-blue-600 rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="font-medium text-gray-700">Claude 3</span>
                                    <span class="text-blue-600">65%</span>
                                </div>
                                <div class="flex h-2 overflow-hidden text-xs bg-gray-100 rounded-full">
                                    <div style="width: 65%" class="bg-blue-600 rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="font-medium text-gray-700">LLaMA 3</span>
                                    <span class="text-blue-600">48%</span>
                                </div>
                                <div class="flex h-2 overflow-hidden text-xs bg-gray-100 rounded-full">
                                    <div style="width: 48%" class="bg-blue-600 rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="font-medium text-gray-700">Gemini</span>
                                    <span class="text-blue-600">34%</span>
                                </div>
                                <div class="flex h-2 overflow-hidden text-xs bg-gray-100 rounded-full">
                                    <div style="width: 34%" class="bg-blue-600 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                        <a href="https://www.shakudo.io/blog/top-9-large-language-models"
                            class="flex items-center justify-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Tüm istatistikleri görüntüle
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Recent Comments -->
                <div class="col-span-1 overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl lg:col-span-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="flex items-center text-lg font-semibold text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Son Yorumlar
                            </h2>
                            <a href="/comments"
                                class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                Tümünü Gör
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentComments as $comment)
                                <div
                                    class="p-4 transition-all duration-200 transform border border-gray-200 rounded-lg bg-gray-50 hover:border-blue-200 hover:-translate-y-1">
                                    <p class="text-sm text-gray-700">
                                        {{ \Illuminate\Support\Str::limit($comment->feedback_text, 100) }}</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            Yorum
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center py-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2 text-gray-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <p class="mb-2 text-gray-500">Henüz yorum yapılmamış.</p>
                                    <a href="/new-comment"
                                        class="px-4 py-2 text-sm text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                        İlk yorumu siz yapın
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                        <a href="/comments"
                            class="flex items-center justify-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Tüm yorumları görüntüle
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Chats -->
            <section class="overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Son Sohbetler
                        </h2>
                        <a href="/chats" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Tümünü Gör
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($recentChats as $chat)
                            <a href="{{ route('chat.show', $chat->id) }}"
                                class="block p-4 transition-all duration-200 transform border border-gray-200 rounded-lg bg-gray-50 hover:bg-blue-50 hover:border-blue-200 hover:-translate-y-1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 mr-3 text-blue-700 bg-blue-100 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $chat->title ?? 'Yeni Sohbet' }}</p>
                                            <div class="flex items-center mt-1 text-xs text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $chat->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 text-white bg-blue-600 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center py-8 text-center col-span-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="mb-2 text-gray-500">Henüz sohbet bulunmuyor.</p>
                                <a href="/new-chat"
                                    class="px-4 py-2 text-sm text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Yeni sohbet başlat
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                    <a href="/chats"
                        class="flex items-center justify-center text-sm font-medium text-blue-600 hover:text-blue-800">
                        Tüm sohbetleri görüntüle
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </section>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Saat ve Tarih
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('tr-TR', {
                hour12: false
            });
            const dateString = now.toLocaleDateString('tr-TR', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('clock').textContent = timeString;
            document.getElementById('date') && (document.getElementById('date').textContent = dateString);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Hızlı Soru Sor
        const questionTextarea = document.querySelector('#quickQuestionForm textarea');
        const charCounter = document.getElementById('questionCharCount');

        questionTextarea.addEventListener('input', function() {
            charCounter.textContent = this.value.length;
        });

        document.getElementById('quickQuestionForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const button = this.querySelector('button');
            button.disabled = true;
            const originalText = button.innerHTML;
            button.innerHTML = `<svg class="w-4 h-4 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> İşleniyor...`;

            try {
                const formData = new FormData(this);
                const question = formData.get('question');

                const response = await fetch('/quick-question', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        question: question
                    })
                });

                const data = await response.json();
                document.getElementById('quickAnswer').classList.remove('hidden');
                document.getElementById('quickAnswerText').textContent = data.answer;
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });

        // Kod Çalıştırma
        document.getElementById('languageSelect').addEventListener('change', function() {
            document.getElementById('selectedLanguage').textContent = this.options[this.selectedIndex].text;
        });

        document.getElementById('codeRunForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const button = this.querySelector('button');
            button.disabled = true;
            const originalText = button.innerHTML;
            button.innerHTML = `<svg class="w-4 h-4 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> İşleniyor...`;

            try {
                const formData = new FormData(this);
                const code = formData.get('code');
                const language = document.getElementById('languageSelect').value;

                const response = await fetch('/code-run', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        code: code,
                        language: language
                    })
                });

                const data = await response.json();
                document.getElementById('codeResult').classList.remove('hidden');
                document.getElementById('codeResultText').textContent = data.result;
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });

        document.getElementById('copyOutput').addEventListener('click', function() {
            const output = document.getElementById('codeResultText').textContent;
            navigator.clipboard.writeText(output).then(() => {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>`;
                setTimeout(() => {
                    this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>`;
                }, 2000);
            });
        });

        // Chart.js - Activity Chart
        const activityData = {
            labels: [
                @foreach (range(6, 0) as $day)
                    '{{ Carbon\Carbon::now()->subDays($day)->format('D') }}',
                @endforeach
            ],
            datasets: [{
                label: 'Toplam Ajan Kullanımı',
                data: [
                    @foreach (range(6, 0) as $day)
                        {{ isset($dailyUsageData[Carbon\Carbon::now()->subDays($day)->format('Y-m-d')]) ? $dailyUsageData[Carbon\Carbon::now()->subDays($day)->format('Y-m-d')]->total : 0 }},
                    @endforeach
                ],
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        };

        const activityCtx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: activityData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart.js - Performance Chart (Mesaj İstatistikleri)
        const performanceData = {
            labels: [
                @foreach (array_keys($dailyChatData) as $date)
                    '{{ \Carbon\Carbon::parse($date)->format('d M') }}',
                @endforeach
            ],
            datasets: [{
                label: 'Gönderilen Mesaj Sayısı',
                data: [
                    @foreach ($dailyChatData as $count)
                        {{ $count }},
                    @endforeach
                ],
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        };

        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(performanceCtx, {
            type: 'bar',
            data: performanceData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart period buttons
        document.querySelectorAll('.chart-period-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.chart-period-btn').forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-50', 'text-blue-700');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });

                // Add active class to clicked button
                this.classList.add('active', 'bg-blue-50', 'text-blue-700');
                this.classList.remove('bg-gray-100', 'text-gray-700');

                const period = this.dataset.period;

                // Update chart data based on period
                if (period === '7') {
                    activityChart.data.labels = [
                        @foreach (range(6, 0) as $day)
                            '{{ Carbon\Carbon::now()->subDays($day)->format('D') }}',
                        @endforeach
                    ];
                    activityChart.data.datasets[0].data = [
                        @foreach (range(6, 0) as $day)
                            {{ isset($dailyUsageData[Carbon\Carbon::now()->subDays($day)->format('Y-m-d')]) ? $dailyUsageData[Carbon\Carbon::now()->subDays($day)->format('Y-m-d')]->total : 0 }},
                        @endforeach
                    ];
                } else if (period === '30') {
                    activityChart.data.labels = [
                        @for ($week = 3; $week >= 0; $week--)
                            '{{ Carbon\Carbon::now()->subWeeks($week)->startOfWeek()->format('d M') }} - {{ Carbon\Carbon::now()->subWeeks($week)->endOfWeek()->format('d M') }}',
                        @endfor
                    ];
                    activityChart.data.datasets[0].data = [
                        @for ($week = 3; $week >= 0; $week--)
                            {{ isset($weeklyUsageData[date('W', strtotime(Carbon\Carbon::now()->subWeeks($week)))]) ? $weeklyUsageData[date('W', strtotime(Carbon\Carbon::now()->subWeeks($week)))]->total : 0 }},
                        @endfor
                    ];
                }

                activityChart.update();
            });
        });

        // Chart metric select
        document.getElementById('chartMetricSelect').addEventListener('change', function() {
            const metric = this.value;

            if (metric === 'daily') {
                performanceChart.data.labels = [
                    @foreach (array_keys($dailyChatData) as $date)
                        '{{ \Carbon\Carbon::parse($date)->format('d M') }}',
                    @endforeach
                ];
                performanceChart.data.datasets[0].label = 'Gönderilen Mesaj Sayısı';
                performanceChart.data.datasets[0].data = [
                    @foreach ($dailyChatData as $count)
                        {{ $count }},
                    @endforeach
                ];
                performanceChart.data.datasets[0].backgroundColor = 'rgba(59, 130, 246, 0.5)';
                performanceChart.data.datasets[0].borderColor = 'rgba(59, 130, 246, 1)';
            } else if (metric === 'monthly') {
                performanceChart.data.labels = [
                    @foreach (array_keys($monthlyChatData) as $month)
                        '{{ \Carbon\Carbon::parse($month)->format('M Y') }}',
                    @endforeach
                ];
                performanceChart.data.datasets[0].label = 'Aylık Mesaj Sayısı';
                performanceChart.data.datasets[0].data = [
                    @foreach ($monthlyChatData as $count)
                        {{ $count }},
                    @endforeach
                ];
                performanceChart.data.datasets[0].backgroundColor = 'rgba(16, 185, 129, 0.5)';
                performanceChart.data.datasets[0].borderColor = 'rgba(16, 185, 129, 1)';
            }

            performanceChart.update();
        });

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            .animate-fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zm20.97 0l9.315 9.314-1.414 1.414L34.828 0h2.83zM22.344 0L13.03 9.314l1.414 1.414L25.172 0h-2.83zM32 0l12.142 12.142-1.414 1.414L30 .828 17.272 13.556l-1.414-1.414L28 0h4zM.284 0l28 28-1.414 1.414L0 2.544v2.83L25.456 30l-1.414 1.414-28-28L0 0h.284zM0 5.373l25.456 25.455-1.414 1.415L0 8.2v2.83l21.628 21.628-1.414 1.414L0 13.657v2.828l17.8 17.8-1.414 1.414L0 19.071v2.83l14.142 14.14-1.414 1.415L0 24.544v2.83l10.314 10.313-1.414 1.414L0 29.97v2.828l6.485 6.485-1.414 1.415L0 35.4v2.827l2.657 2.657-1.414 1.415L0 39.8v2.828l-1.414 1.414L0 41.627v2.83L1.414 45.87.284 47 0 46.717v2.83l.284.284-1.414 1.414L0 47.03v2.97h3.657l-1.414 1.415L0 53.03v2.97h2.83l-1.414 1.415-1.415-1.414L0 58.314v2.83L1.414 60H0v-5.657l1.414 1.415-.284.284h5.657l-1.414 1.414L0 58.97V60h8.485l-1.414-1.414 1.414-1.414h5.657l-1.414 1.414L11.314 60h2.83l1.414-1.414 1.414 1.414h2.83l1.414-1.414 1.414 1.414h2.83L25.456 60h5.657l-1.414-1.414 1.414-1.414h2.83l2.828 2.828h2.83L35.03 56.97l8.485-8.485-1.414-1.414 1.414-1.414-7.07-7.07 1.414-1.415-1.414-1.414 5.657-5.657-1.414-1.414 1.414-1.414-4.243-4.243 1.414-1.414-1.414-1.414 2.83-2.83-1.415-1.414 1.414-1.414L30 16.97l1.414-1.414-1.414-1.414 1.414-1.414-2.83-2.83L30 7.072l-1.414-1.414 2.83-2.83L30 1.414 28.584 0h2.83l1.414 1.414L34.242 0h2.83l-1.414 1.414L37.07 0h2.83l-1.414 1.414L39.9 0h2.83L41.313 1.414 42.728 0h2.83L44.14 1.414 45.557 0h2.83l-1.414 1.414L48.385 0h2.83l-1.414 1.414L51.213 0h2.83L52.627 1.414 54.04 0h2.83l-1.414 1.414L56.87 0h2.83L58.284 1.414 59.7 0h.3v1.414l-1.414 1.414L60 4.242V7.07l-1.414 1.415L60 9.9v2.83l-1.414 1.414L60 15.557v2.83l-1.414 1.414L60 21.213v2.83l-1.414 1.414L60 26.87v2.83l-1.414 1.414L60 32.527v2.83l-1.414 1.414L60 38.184v2.83l-1.414 1.414L60 43.84v2.83l-1.414 1.414L60 49.5v2.83l-1.414 1.414L60 55.157v2.83l-1.414 1.414L60 60h-2.83l1.414-1.414L56.87 60h-2.83l1.414-1.414L53.657 60H50.83l1.414-1.414L50.83 60h-2.83l1.414-1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414-1.414 1.414-1.414-1.414L15.1 60h-2.83l1.415-1.414-1.414-1.414-1.414 1.414-1.414-1.414-2.83 2.83h-2.83l1.414-1.416-1.414-1.414-1.414 1.414-1.414-1.414L0 58.314V60h60V0H0v56.97z' fill='%23ffffff' fill-opacity='.2' fill-rule='evenodd'/%3E%3C/svg%3E");
            }

            .scrollbar-thin::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            .scrollbar-thin::-webkit-scrollbar-track {
                background: #2d3748;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb {
                background-color: #4a5568;
                border-radius: 4px;
            }

            .transform {
                transition-property: transform;
            }

            .duration-200 {
                transition-duration: 200ms;
            }

            .hover\:-translate-y-1:hover {
                transform: translateY(-0.25rem);
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
