@extends('layouts.app')

@section('title', 'Sohbetler')

@section('content')

<div class="flex items-center justify-between pb-4 mb-6 border-b">
    <h2 class="text-xl font-medium text-gray-700">Sohbet Geçmişi</h2>

    <a href="{{ route('chat.create') }}" class="px-4 py-2 font-normal text-white transition-colors bg-blue-600 rounded-sm hover:bg-blue-700">
        <span class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yeni Sohbet
        </span>
    </a>
</div>

@if($chats->count() > 0)
    <div class="grid grid-cols-1 gap-3">
        @foreach ($chats as $chat)
            <a href="{{ route('chat.show', $chat->id) }}" class="block p-4 transition-colors bg-white border border-gray-200 rounded-sm hover:bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-base font-medium text-gray-700">{{ $chat->title }}</div>
                        <div class="mt-1 text-sm text-gray-500">{{ $chat->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                    <div class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@else
    <div class="p-6 text-center bg-white border border-gray-200 rounded-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <p class="text-base text-gray-600">Henüz kayıtlı bir sohbet bulunmamaktadır.</p>
        <a href="{{ route('chat.create') }}" class="inline-block px-5 py-2 mt-4 font-normal text-white transition-colors bg-blue-600 rounded-sm hover:bg-blue-700">
            <span class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                </svg>
                Yeni Sohbet Başlat
            </span>
        </a>
    </div>
@endif

@endsection
