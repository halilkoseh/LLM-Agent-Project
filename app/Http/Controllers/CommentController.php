<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Models\AppModel;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $feedbacks = UserFeedback::with([
            'modelOutput.model',
            'modelOutput.request'
        ])
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        $averageRating = $feedbacks->avg('rating') ?? 0;

        return view('comments.index', compact('feedbacks', 'averageRating'));
    }


    public function update(Request $request, $id)
    {
        $feedback = UserFeedback::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $feedback->update([
            'rating' => $request->input('rating'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return redirect()->route('comments.index')->with('success', 'Yorum güncellendi.');
    }

    public function destroy($id)
    {
        $feedback = UserFeedback::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $feedback->delete();

        return redirect()->route('comments.index')->with('success', 'Yorum silindi.');
    }
}
