@extends('layouts.app')

@section('title', 'Ajan')

@section('content')

<div class="max-w-6xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
    <div class="p-6 bg-white border border-gray-200 rounded-md shadow-md sm:p-8">
        <!-- Header Section -->
        <div class="flex flex-col items-start justify-between pb-4 mb-6 border-b border-gray-200 sm:flex-row sm:items-center">
            <h1 class="text-2xl font-semibold text-gray-800">
                Ajan Geçmişi
            </h1>
            <a href="/analyze-page" class="flex items-center px-5 py-2 mt-4 text-white bg-blue-700 rounded shadow-sm hover:bg-blue-800 sm:mt-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Yeni Analiz
            </a>
        </div>

        <!-- History List -->
        <div class="space-y-4">
            @foreach ($requests as $req)
                <div class="bg-white border border-gray-300 rounded-sm shadow-sm">
                    <!-- Request Header -->
                    <div class="flex flex-wrap items-center gap-3 px-4 py-3 bg-gray-100 border-b border-gray-300">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 text-xs font-medium text-blue-900 bg-blue-100 rounded">#{{ $req->id }}</span>
                            <span class="px-2 py-0.5 text-xs font-medium text-gray-900 bg-gray-200 rounded">
                                {{ $req->language }}
                            </span>
                            <span class="px-2 py-0.5 text-xs font-medium text-gray-900 bg-gray-200 rounded">
                                {{ $req->request_type }}
                            </span>
                        </div>
                        <div class="ml-auto text-xs text-gray-600">
                            {{ $req->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Code Content -->
                    <div class="p-4 space-y-4">
                        <div class="space-y-2">
                            <h3 class="text-xs font-bold text-gray-800 uppercase">Kod İçeriği</h3>
                            <pre class="p-3 overflow-x-auto font-mono text-sm text-gray-200 bg-gray-900 border border-gray-400 rounded">{{ $req->content }}</pre>
                        </div>

                        <!-- Model Outputs -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-gray-800 uppercase">Model Yanıtları</h3>
                            <div class="grid grid-cols-1 gap-3 lg:grid-cols-2">
                                @foreach ($req->modelOutputs as $output)
                                    <div class="p-3 bg-white border border-gray-300 rounded">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-gray-700">
                                                    {{ $output->model->model_name }}
                                                </span>
                                                <span class="text-xs px-2 py-0.5 rounded
                                                    {{ $output->model->provider === 'OpenAI' ? 'bg-gray-200 text-gray-800' : 'bg-gray-200 text-gray-800' }}">
                                                    {{ $output->model->provider }}
                                                </span>
                                            </div>
                                            <span class="text-xs text-gray-500">ID: {{ $output->id }}</span>
                                        </div>
                                        <pre class="p-2 overflow-x-auto font-mono text-sm border border-gray-300 rounded-sm bg-gray-50">{{ $output->output_content }}</pre>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
