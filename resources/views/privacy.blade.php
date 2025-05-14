@extends('layouts.app')

@section('title', 'Gizlilik Politikası')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Gizlilik Politikası</h1>
            <p class="text-sm text-gray-600 mt-2">Son güncelleme: 1 Nisan 2025</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Giriş</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Bu gizlilik politikası, LLM Ajanları ile Yapay Zekâ Tabanlı Etkileşimli Yazılım Geliştirme Platformu'nun kullanıcılarının kişisel bilgilerini nasıl topladığını, kullandığını ve koruduğunu açıklar.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Toplanan Bilgiler</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Web sitemiz, kullanıcıların kişisel bilgilerini toplamak için çeşitli yöntemler kullanabilir. Bu veriler, kullanıcı deneyimini iyileştirmek ve güvenliği artırmak amacıyla kullanılacaktır. Toplanan bilgiler arasında şunlar yer alabilir:
            </p>
            <ul class="list-disc pl-6 mt-2 text-sm text-gray-700 space-y-1">
                <li>Kişisel bilgiler (ad, soyad, e-posta, telefon numarası vb.)</li>
                <li>Teknik veriler (IP adresi, tarayıcı türü, sistem özellikleri vb.)</li>
                <li>Kullanıcı etkileşimleri (kullanıcı talep türleri, tercih edilen çıktı türleri, yazılım hatası geri bildirimleri vb.)</li>
            </ul>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Verilerin Kullanımı</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Toplanan bilgiler, yazılım geliştirme süreçlerini hızlandırmak, güvenliği artırmak ve daha işlevsel çözümler sunmak için kullanılabilir. Özellikle:
            </p>
            <ul class="list-disc pl-6 mt-2 text-sm text-gray-700 space-y-1">
                <li>Yazılım testlerinin hızlandırılması ve hataların tespit edilmesi</li>
                <li>Kullanıcı etkileşimleri doğrultusunda geri bildirim sağlanması</li>
                <li>Kişisel verilerin korunarak sistem güvenliğinin sağlanması</li>
            </ul>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Çerezler (Cookies)</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Sitemiz, kullanıcı deneyimini geliştirmek için çerezler kullanabilir. Çerezler, web tarayıcınız tarafından cihazınıza yerleştirilen küçük veri dosyalarıdır. Bu dosyalar, sistemin işlevselliğini artırmaya yardımcı olmaktadır.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Veri Güvenliği</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Kişisel verilerinizin güvenliğini sağlamak için gelişmiş güvenlik önlemleri alınmaktadır. Ancak, internet üzerinden veri iletimi tamamen güvenli değildir, bu nedenle kullanıcı verilerinin güvenliği her aşamada korunmaktadır.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Veri Paylaşımı</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Kullanıcı verileri üçüncü şahıslarla paylaşılmayacak olup, yalnızca yasal gereklilikler veya güvenlik tehditleri durumunda veriler paylaşılabilir.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Proje Güvenliği ve Gizliliği</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Bu platform, kullanıcıların kişisel verilerini her zaman gizli tutmayı taahhüt eder. Platformda yapılan etkileşimlerin tümü, güvenli bir şekilde işlenir ve kullanıcı verilerinin her aşamada korunması sağlanır.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Değişiklikler</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Bu gizlilik politikası zaman içinde güncellenebilir. Değişiklikler yapıldığında, sayfanın üst kısmında tarih belirtilecektir.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-4">
            <h2 class="text-lg font-medium text-gray-800 mb-3">İletişim</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Gizlilik politikamız hakkında herhangi bir sorunuz varsa, bizimle iletişime geçebilirsiniz:
            </p>
            <div class="flex items-center mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <a href="mailto:halilulucakk@icloud.com" class="text-sm text-blue-600 hover:underline">halilulucakk@icloud.com</a>
            </div>
        </div>

        <div class="text-center mt-8 text-xs text-gray-500">
            <p>© 2025 LLM Platform. Tüm hakları saklıdır.</p>
        </div>
    </div>
@endsection
