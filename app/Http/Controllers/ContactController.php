<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * İletişim sayfasını göster
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * İletişim formunu işle
     */
    public function submit(Request $request)
    {
        // Form verilerini doğrula
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Veritabanına kaydet
        Contact::create($validated);

        // İsteğe bağlı: E-posta gönder
        // Mail::to('admin@example.com')->send(new ContactFormSubmitted($validated));

        // Başarı mesajıyla yönlendir
        return redirect()->route('contact.index')
            ->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }

    /**
     * Admin: Tüm mesajları listele
     */
    public function list()
    {
        // Bu metod yalnızca admin kullanıcılar için erişilebilir olmalı
        $messages = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * Admin: Mesaj detaylarını göster
     */
    public function show(Contact $contact)
    {
        // Bu metod yalnızca admin kullanıcılar için erişilebilir olmalı
        // Mesajı okundu olarak işaretle
        $contact->update(['is_read' => true]);

        return view('admin.contacts.show', compact('contact'));
    }
}
