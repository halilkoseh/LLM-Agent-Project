@extends('layouts.apps')

@section('title', 'Sohbet')

@section('content')
    <div class="h-screen flex flex-col bg-gray-100">
        <!-- Header -->
        <header
            class="bg-gray-300 shadow-sm border-b border-gray-200 py-3 px-4 flex items-center justify-between fixed top-16 left-0 right-0 z-20">
            <div class="flex items-center space-x-3">
                <button id="historyToggle" class="p-2 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-900 truncate">{{ $chat->title ?: 'Yeni Sohbet' }}</h1>
            </div>
            <div class="flex items-center space-x-2">
                <span
                    class="text-xs text-gray-500 hidden sm:block">{{ $chat->created_at->translatedFormat('d F Y, H:i') }}</span>
                <a href="{{ route('chat.create') }}" class="p-2 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </a>
            </div>
        </header>

        <!-- Chat History Sidebar (Hidden by default on mobile) -->
        <div id="historyPanel"
            class="fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-30 w-72 bg-white shadow-lg">
            <div class="h-full flex flex-col pt-16 pb-4">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Sohbet Geçmişi</h2>
                </div>

                <div class="flex-1 overflow-y-auto px-3 py-2 space-y-1 custom-scrollbar">
                    @foreach ($chats as $c)
                        <a href="{{ route('chat.show', $c->id) }}"
                            class="flex items-center gap-2 p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition
                        {{ $c->id == $chat->id ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                            <span
                                class="w-7 h-7 flex-shrink-0 flex items-center justify-center bg-indigo-100 rounded-full text-indigo-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </span>
                            <span class="truncate text-sm flex-1">{{ $c->title ?: 'Yeni Sohbet' }}</span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-auto border-t border-gray-200 pt-3 px-3">
                    <form action="{{ route('chat.delete', $chat->id) }}" method="POST"
                        onsubmit="return confirm('Bu sohbeti silmek istediğinizden emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center gap-2 p-2 w-full rounded-lg text-red-600 hover:bg-red-50 transition text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Sohbeti Sil</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for sidebar -->
        <div id="historyOverlay" class="fixed inset-0 bg-black bg-opacity-30 z-20 hidden" aria-hidden="true"></div>

        <!-- Main Chat Area -->
        <main class="flex-1 flex flex-col pt-14 max-h-screen overflow-hidden ">
            <!-- Messages Container -->
            <div id="messagesContainer" class="flex-1 overflow-y-auto px-4 py-4 custom-scrollbar">
                <div class="max-w-3xl mx-auto space-y-4 pb-20">
                    @php
                        $previousSender = null;
                        $messagesGrouped = [];
                        $currentGroup = [];

                        // Group messages by user interaction (user message followed by AI responses)
                        foreach ($chat->messages as $message) {
                            if ($message->sender === 'user' && $previousSender !== 'user') {
                                if (!empty($currentGroup)) {
                                    $messagesGrouped[] = $currentGroup;
                                    $currentGroup = [];
                                }
                            }

                            $currentGroup[] = $message;
                            $previousSender = $message->sender;
                        }

                        if (!empty($currentGroup)) {
                            $messagesGrouped[] = $currentGroup;
                        }
                    @endphp

                    @foreach ($messagesGrouped as $group)
                        @php
                            $userMessage = null;
                            $aiResponses = [];

                            foreach ($group as $message) {
                                if ($message->sender === 'user') {
                                    $userMessage = $message;
                                } else {
                                    $aiResponses[] = $message;
                                }
                            }
                        @endphp

                        <!-- User Message -->
                        @if ($userMessage)
                            <div class="chat-message user-message animate-fadeIn">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm font-medium text-gray-800 mb-1">Sen</div>
                                        <div
                                            class="text-sm text-gray-700 leading-relaxed  message-content">
                                            {{ $userMessage->content }}
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $userMessage->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- AI Responses -->
                        @if (count($aiResponses) === 1)
                            <!-- Single AI Response -->
                            <div class="chat-message ai-message animate-fadeIn">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                                            {{ $aiResponses[0]->model_name == 'OPENAI' ? 'bg-green-100' : 'bg-blue-100' }}">
                                        @if ($aiResponses[0]->model_name == 'OPENAI')
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.5093-2.6067-1.4998z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm font-medium text-gray-800 mb-1">
                                            {{ $aiResponses[0]->model_name == 'OPENAI' ? 'ChatGPT' : 'Gemini' }}
                                        </div>
                                        <div
                                            class="text-sm text-gray-700 leading-relaxed  message-content">
                                            {{ $aiResponses[0]->content }}
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $aiResponses[0]->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (count($aiResponses) > 1)
                            <!-- Multiple AI Responses (2-column) -->
                            <div class="chat-message ai-message-dual animate-fadeIn">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach ($aiResponses as $aiResponse)
                                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                            <div class="flex items-center gap-2 mb-3">
                                                <div
                                                    class="w-7 h-7 rounded-full flex items-center justify-center
                                                    {{ $aiResponse->model_name == 'OPENAI' ? 'bg-green-100' : 'bg-blue-100' }}">
                                                    @if ($aiResponse->model_name == 'OPENAI')
                                                        <svg class="w-4 h-4 text-green-600" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.5093-2.6067-1.4998z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="text-sm font-medium text-gray-800">
                                                    {{ $aiResponse->model_name == 'OPENAI' ? 'ChatGPT' : 'Gemini' }}
                                                </div>
                                                <div class="text-xs text-gray-400 ml-auto">
                                                    {{ $aiResponse->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                            <div
                                                class="text-sm text-gray-700 leading-relaxed  message-content">
                                                {{ $aiResponse->content }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Message Input (Fixed at bottom) -->
            <div class="fixed bottom-0 left-0 right-0 bg-[#D1D5DA] border-t border-gray-200 shadow-md z-10">
                <div class="max-w-3xl mx-auto px-4 py-3">
                    <form id="sendMessageForm" class="relative">
                        <textarea id="messageContent" rows="1" required
                            class="w-full resize-none border border-gray-300 rounded-2xl py-3 pl-4 pr-12 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 transition"
                            placeholder="Mesajınızı yazın..."></textarea>
                        <button type="submit"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 p-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>

                    <!-- Loading Spinner -->
                    <div id="loadingSpinner"
                        class="hidden mt-2 flex justify-center items-center space-x-2 text-gray-500 pb-1">
                        <div class="w-4 h-4 border-2 border-gray-300 border-t-indigo-600 rounded-full animate-spin"></div>
                        <span class="text-xs font-medium">Yanıt oluşturuluyor...</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.3);
            border-radius: 20px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.5);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Prevent content from being hidden behind fixed elements */
        body {
            overscroll-behavior-y: none;
        }

        /* Message styling */
        .chat-message {
            position: relative;
            padding: 1rem 0;
        }

        .chat-message:not(:last-child):after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(229, 231, 235, 0.8);
        }

        .message-content {
            word-break: break-word;
        }

        /* Comparison view styling */
        .ai-message-dual {
            position: relative;
            padding: 1rem 0;
        }

        .ai-message-dual:not(:last-child):after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(229, 231, 235, 0.8);
        }

        @media (max-width: 639px) {
            .ai-message-dual .grid>div:not(:last-child) {
                margin-bottom: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const historyPanel = document.getElementById('historyPanel');
            const historyToggle = document.getElementById('historyToggle');
            const historyOverlay = document.getElementById('historyOverlay');
            const messagesContainer = document.getElementById('messagesContainer');

            // History panel toggle functionality
            historyToggle.addEventListener('click', function() {
                historyPanel.classList.toggle('-translate-x-full');
                historyOverlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });

            historyOverlay.addEventListener('click', function() {
                historyPanel.classList.add('-translate-x-full');
                historyOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            // Scroll messages to bottom
            scrollToBottom();

            // Textarea auto resize
            const messageTextarea = document.getElementById('messageContent');
            messageTextarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 150) + 'px';
            });

            // Focus textarea on page load
            messageTextarea.focus();

            // Handle form submission
            document.getElementById('sendMessageForm').addEventListener('submit', async function(event) {
                event.preventDefault();
                const content = messageTextarea.value.trim();
                if (!content) return;

                // Disable inputs during loading
                messageTextarea.disabled = true;
                document.querySelector('#sendMessageForm button').disabled = true;
                document.getElementById('loadingSpinner').classList.remove('hidden');

                try {
                    const response = await fetch("{{ route('chat.sendMessage', $chat->id) }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            content
                        })
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        const errorData = await response.json();
                        alert(errorData.message || "Mesaj gönderilirken hata oluştu.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Bağlantı hatası oluştu. Lütfen tekrar deneyin.");
                } finally {
                    messageTextarea.disabled = false;
                    document.querySelector('#sendMessageForm button').disabled = false;
                    messageTextarea.value = '';
                    messageTextarea.style.height = 'auto';
                    document.getElementById('loadingSpinner').classList.add('hidden');
                }
            });

            // Handle Enter key for submission
            messageTextarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('sendMessageForm').dispatchEvent(new Event('submit'));
                }
            });

            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        });
    </script>
@endsection
