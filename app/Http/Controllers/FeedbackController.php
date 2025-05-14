<?php

namespace App\Http\Controllers;

use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request)
    {
        $request->validate([
            'model_output_id' => 'required|exists:model_outputs,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback_text' => 'nullable|string|max:1000',
        ]);

        $feedback = UserFeedback::create([
            'user_id' => Auth::id(),
            'model_output_id' => $request->input('model_output_id'),
            'rating' => $request->input('rating'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return response()->json([
            'message' => 'Geri bildirim başarıyla kaydedildi!',
            'feedback' => $feedback
        ]);
    }

    
}
