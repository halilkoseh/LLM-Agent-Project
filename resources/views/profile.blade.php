@extends('layouts.app')

@section('title', 'Profilim')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-6 sm:p-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">
                Profil Ayarları
            </h1>
            <a href="/dashboard" class="flex items-center space-x-1 text-blue-600 hover:text-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                <span class="font-medium">Dashboard'a Dön</span>
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="text-red-700">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- User Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-5 rounded border border-gray-200">
                <h2 class="text-lg font-medium mb-4 flex items-center text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Kullanıcı Bilgileri
                </h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-600">Ad Soyad</label>
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">E-posta</label>
                        <p class="font-medium text-gray-900">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-5 rounded border border-gray-200">
                <h2 class="text-lg font-medium mb-4 flex items-center text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Güvenlik Bilgileri
                </h2>
                <p class="text-sm text-gray-600">Son şifre değişikliği:
                    <span class="font-medium text-gray-900">
                        {{ $user->password_changed_at ? $user->password_changed_at->diffForHumans() : 'Kayıtlı değil' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Password Update Form -->
        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-lg font-medium mb-5 flex items-center text-gray-800">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                Şifre Değiştir
            </h2>

            <form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Şifre</label>
                        <input type="password" name="current_password" required
                            class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="••••••••">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Yeni Şifre</label>
                            <input type="password" name="new_password" required
                                class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="En az 8 karakter">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Şifre Tekrar</label>
                            <input type="password" name="new_password_confirmation" required
                                class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="Şifrenizi tekrar girin">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded transition-all">
                    Şifreyi Güncelle
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
