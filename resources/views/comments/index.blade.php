@extends('layouts.app')

@section('title', 'Yorumlarım')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Yorumlarım ve Puanlarım</h1>
            <span class="text-sm text-gray-500">{{ $feedbacks->count() }} yorum</span>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Ortalama Puan Kartı -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 shadow-sm rounded-xl p-6 mb-10">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="flex items-center space-x-6 mb-4 sm:mb-0">
                    <div class="text-5xl font-bold text-blue-600">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($averageRating))
                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="text-gray-700">
                    <div class="text-lg font-semibold">Ortalama Puanınız</div>
                    <div class="text-sm text-gray-500">Tüm yorumlar üzerinden hesaplanır</div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            @forelse($feedbacks as $feedback)
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <!-- Model ve İlgili İstek -->
                        <div class="border-b border-gray-100 pb-4">
                            <div class="flex justify-between items-start">

                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>

                            <!-- Sorgu ve çıktı detayları -->
                            <div class="mt-4 space-y-3">
                                <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                                    <p class="text-gray-600 font-medium mb-1 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                            </path>
                                        </svg>
                                        Sorgu:
                                    </p>
                                    <p class="text-gray-800">
                                        {{ $feedback->modelOutput->request->content ?? 'İçerik bulunamadı' }}</p>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                                    <p class="text-gray-600 font-medium mb-1 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                            </path>
                                        </svg>
                                        Model Çıktısı:
                                    </p>
                                    <p class="text-gray-800">
                                        {{ \Illuminate\Support\Str::limit($feedback->modelOutput->output_content, 300) ?? 'Çıktı bulunamadı' }}
                                    </p>
                                    @if (strlen($feedback->modelOutput->output_content) > 300)
                                        <button class="text-blue-500 text-sm mt-2 hover:underline">Devamını Gör</button>
                                    @endif
                                </div>

                                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                        {{ $feedback->modelOutput->request->language ?? 'Dil belirtilmemiş' }}
                                    </span>
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        {{ $feedback->modelOutput->request->request_type ?? 'Tür belirtilmemiş' }}
                                    </span>
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $feedback->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Yorum ve Puan Form -->
                        <div class="pt-4">
                            <form action="{{ route('comments.update', $feedback->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="feedback_text_{{ $feedback->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">Yorumunuz</label>
                                    <textarea id="feedback_text_{{ $feedback->id }}" name="feedback_text"
                                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                        rows="2" placeholder="Düşüncelerinizi paylaşın...">{{ $feedback->feedback_text }}</textarea>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div>

                                        <div class="flex items-center space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="star{{ $i }}_{{ $feedback->id }}"
                                                    name="rating" value="{{ $i }}" class="hidden"
                                                    {{ $feedback->rating == $i ? 'checked' : '' }}>
                                                <label for="star{{ $i }}_{{ $feedback->id }}"
                                                    class="cursor-pointer">
                                                    <svg class="w-8 h-8 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="flex space-x-3">


                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                            Güncelle
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-10 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-lg">Henüz yorum yapmadınız.</p>
                    <p class="text-gray-400 mt-2">Model çıktılarına verdiğiniz yorumlar burada görünecek.</p>
                    <a href="#"
                        class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        Modelleri Keşfet
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination eklenebilir -->
    </div>
@endsection
