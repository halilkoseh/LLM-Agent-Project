<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as CodeRequest;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $requests = CodeRequest::with('modelOutputs.model')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('requests'));
    }
}
