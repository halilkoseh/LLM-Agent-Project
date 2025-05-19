<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/llmplatform', function () {
    return view('auth.login');
});




use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\RequestController;

Route::middleware(['auth'])->group(function () {
    Route::post('/analyze', [RequestController::class, 'analyze'])->name('analyze');
});



Route::get('/analyze-page', function () {
    return view('analyze');
})->middleware(['auth']);


use App\Http\Controllers\FeedbackController;

Route::middleware(['auth'])->group(function () {
    Route::post('/feedback', [FeedbackController::class, 'sendFeedback'])->name('feedback.send');
});


use App\Http\Controllers\HistoryController;

Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});


use App\Http\Controllers\QuickQuestionController;

Route::middleware(['auth'])->group(function () {
    Route::post('/quick-question', [QuickQuestionController::class, 'ask'])->name('quick.question');
});

use App\Http\Controllers\CodeRunController;

Route::middleware(['auth'])->group(function () {
    Route::post('/code-run', [CodeRunController::class, 'run'])->name('code.run');
});


use App\Http\Controllers\ChatController;

Route::middleware(['auth'])->group(function () {

    // Chat Ana Sayfa (Tüm sohbetler listeleniyor)
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    // Yeni Sohbet Başlat Sayfası
    Route::get('/chat/create', function() {
        return view('chat.create');
    })->name('chat.create');

    // Yeni Sohbet Başlat (Formdan gelen veri)
    Route::post('/chat/start', [ChatController::class, 'start'])->name('chat.start');

    // Belirli Bir Chat Göster (ID ile)
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');

    // Mesaj Gönder (Chat içinden)
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');

    // Chat Silme
    Route::delete('/chat/{id}', [ChatController::class, 'delete'])->name('chat.delete');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

});


Route::get('/about', function () {
    return view('about');
})->name('about');

use App\Http\Controllers\CommentController;
Route::get('/comments', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
Route::post('/comments/{id}/update', [App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}/delete', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');


Route::get('/contact', action: function () {
    return view('contact');
})->name('contact');




use App\Http\Controllers\ContactController;

// İletişim sayfası ve form gönderimi
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');





require __DIR__.'/auth.php';
