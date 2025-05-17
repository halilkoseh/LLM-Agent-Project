@extends('layouts.app')

@section('title', 'LLM Ajanı')

@section('content')

    <div class="max-w-4xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 transition-all duration-300 bg-white shadow-xl rounded-2xl sm:p-8 hover:shadow-2xl">

            <!-- Header Section -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Kod Analizi
                </h1>
                <a href="/history" class="flex items-center space-x-1 text-blue-600 transition-colors hover:text-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Geçmiş</span>
                </a>
            </div>

            <!-- Analysis Form -->
            <form id="analyzeForm" class="space-y-8">
                <div class="space-y-4">

                    <!-- Language and Request Type -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="flex items-center block text-sm font-medium text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                                </svg>
                                Programlama Dili
                            </label>
                            <select name="language" class="w-full px-4 py-3 border rounded-lg">
                                <option value="Python">Python</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="Java">Java</option>
                                <option value="C">C</option>
                                <option value="Go">Go</option>


                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center block text-sm font-medium text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Analiz Türü
                            </label>
                            <select name="request_type" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Explain Code in Turkish">Kod Açıklaması</option>
                                <option value="Fix Code">Hata Düzeltme</option>
                                <option value="Optimize Code">Optimizasyon</option>
                                <option value="Documentation from Code">Dokümantasyon (Açıklama ve Yorumlar)</option>
                                <option value="Unit Tests for Code">Unit Testleri</option>
                                <option value="Interface Tests for Code">Arayüz Testleri</option>
                            </select>

                        </div>
                    </div>

                    <!-- Code Area -->
                    <div class="relative overflow-hidden bg-gray-900 border border-gray-700 rounded-lg shadow-2xl">
                        <!-- VS Code Tab Bar -->
                        <div class="flex items-center px-4 py-2 bg-gray-800 border-b border-gray-700">
                            <div class="flex space-x-2">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="ml-6 font-mono text-sm text-gray-400 truncate">analyze.llm</div>
                        </div>

                        <!-- Kod Alanı -->
                        <div class="relative">
                            <textarea name="content" rows="14"
                                class="w-full h-full px-8 py-6 font-mono text-sm leading-relaxed text-gray-200 bg-gray-900 resize-none focus:outline-none focus:ring-0 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-800 caret-blue-400 selection:bg-blue-900/60"
                                placeholder="// Kodunuz buraya..." spellcheck="false"
                                onkeydown="if(event.key === 'Tab') { event.preventDefault(); var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.substring(0, start) + '    ' + this.value.substring(end); this.selectionStart = this.selectionEnd = start + 4; }"></textarea>

                            <!-- Sağ Alt Bilgi Barı -->
                            <div
                                class="absolute flex items-center space-x-4 font-mono text-xs text-gray-500 bottom-2 right-4">
                                <span>UTF-8</span>
                                <span id="selected-language">JavaScript</span>
                                <span id="position">Ln 1, Col 1</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ek Notlar Alanı -->
                    <div class="mt-6">
                        <label class="flex items-center block mb-2 text-sm font-medium text-gray-700">
                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Ek Talimatlar (İsteğe Bağlı)
                        </label>
                        <div class="relative">
                            <textarea name="additional_notes" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ör: Kodun güvenliğini değerlendir, verimliliğini açıkla, belirli bir konuda detaya gir..."></textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Yapay zeka modellerine özel talimatlar veya isteklerinizi buraya yazabilirsiniz.</p>
                    </div>
                </div>

                <!-- CSS -->
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;600&display=swap');

                    textarea {
                        font-family: 'Source Code Pro', monospace;
                    }

                    .scrollbar-thin::-webkit-scrollbar {
                        width: 6px;
                        height: 6px;
                    }

                    .scrollbar-thin::-webkit-scrollbar-thumb {
                        background: #4a5568;
                        border-radius: 4px;
                    }

                    .scrollbar-thin::-webkit-scrollbar-track {
                        background: #2d3748;
                    }
                </style>

                <!-- JS -->
                <script>
                    // Satır ve kolon gösterimi
                    const textarea = document.querySelector('textarea[name="content"]');
                    const position = document.getElementById('position');
                    const languageSelect = document.querySelector(
                        'select[name="language"]'); // select elementini name attribute'u ile seçiyoruz
                    const selectedLanguage = document.getElementById('selected-language');

                    // Sayfa yüklendiğinde seçili olan dili göster
                    selectedLanguage.textContent = languageSelect.value;

                    textarea.addEventListener('input', updatePosition);
                    textarea.addEventListener('click', updatePosition);
                    textarea.addEventListener('keyup', updatePosition);

                    function updatePosition() {
                        const val = textarea.value.substr(0, textarea.selectionStart);
                        const lines = val.split("\n");
                        const line = lines.length;
                        const col = lines[lines.length - 1].length + 1;
                        position.textContent = `Ln ${line}, Col ${col}`;
                    }

                    // Dil seçimi değişince sağ alta yaz
                    languageSelect.addEventListener('change', () => {
                        selectedLanguage.textContent = languageSelect.value;
                    });
                </script>


                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-3.5 rounded-lg transition">
                    Ajanı Başlat </button>
        </div>
        </form>

        <!-- Result Section -->
        <div id="result" class="hidden mt-10 space-y-8">
            <h2 class="pl-4 text-2xl font-semibold text-gray-800 border-l-4 border-blue-600">Analiz Sonuçları</h2>
            <div id="outputs" class="space-y-6"></div>
        </div>

    </div>
    </div>

    <script>
        document.getElementById('analyzeForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const submitBtn = event.target.querySelector('button[type="submit"]');

            const modelNames = {
                1: 'OpenAI',
                2: 'Google',
                3: 'Meta'
            };

            try {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Analiz Yapılıyor...';

                const response = await fetch('/analyze', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();
                document.getElementById('result').classList.remove('hidden');

                const outputsDiv = document.getElementById('outputs');
                outputsDiv.innerHTML = '';

                data.outputs.forEach(output => {
                    const card = document.createElement('div');
                    card.className = 'bg-gray-50 p-6 rounded-xl border border-gray-200';
                    card.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-blue-600">${modelNames[output.model_id] ?? 'Model'} Çıktısı</h3>
                    <span class="text-sm text-gray-500">ID: ${output.model_id}</span>
                </div>

                <pre class="p-4 mb-6 overflow-x-auto text-sm text-gray-100 bg-gray-800 rounded-lg">${output.output_content}</pre>

                <div class="p-4 bg-white border rounded-lg">
                    <form onsubmit="sendFeedback(event, ${output.id})" class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Puan (1-5)</label>
                                <input type="number" name="rating" min="1" max="5" required class="w-full px-3 py-2 border rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Yorum</label>
                                <textarea name="feedback_text" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="px-6 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                            Geri Bildirim Gönder
                        </button>
                    </form>
                </div>
            `;
                    outputsDiv.appendChild(card);
                });

            } catch (error) {
                console.error('Error:', error);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '🚀 Analizi Başlat';
            }
        });

        // Feedback gönderme fonksiyonu
        async function sendFeedback(event, modelOutputId) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const feedbackBtn = form.querySelector('button[type="submit"]');

            try {
                feedbackBtn.disabled = true;
                feedbackBtn.innerHTML = 'Gönderiliyor...';

                const payload = {
                    model_output_id: modelOutputId,
                    rating: formData.get('rating'),
                    feedback_text: formData.get('feedback_text'),
                };

                const response = await fetch('/feedback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                const confirmation = document.createElement('div');
                confirmation.className = 'text-green-600 text-sm mt-2';
                confirmation.innerHTML = '✅ Geri Bildirim Gönderildi';
                form.parentNode.insertBefore(confirmation, form.nextSibling);

                setTimeout(() => confirmation.remove(), 3000);
                form.reset();

            } catch (error) {
                console.error('Error:', error);
            } finally {
                feedbackBtn.disabled = false;
                feedbackBtn.innerHTML = 'Geri Bildirim Gönder';
            }
        }
    </script>

@endsection
