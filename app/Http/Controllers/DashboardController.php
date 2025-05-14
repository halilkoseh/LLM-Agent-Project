<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as CodeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\UserFeedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalRequests = CodeRequest::where('user_id', $user->id)->count();
        $totalFeedbacks = UserFeedback::where('user_id', $user->id)->count();

        // Get the latest request's updated_at timestamp
        $lastRequest = CodeRequest::where('user_id', $user->id)
            ->latest('updated_at')
            ->first();

        // Fetch recent comments and chats
        $recentComments = UserFeedback::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentChats = Chat::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Son 7 günlük ajan kullanım verileri
        $dailyUsageData = CodeRequest::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Son 30 günlük ajan kullanım verileri (haftalık gruplandırılmış)
        $weeklyUsageData = CodeRequest::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(DB::raw('WEEK(created_at) as week'), DB::raw('count(*) as total'))
            ->groupBy('week')
            ->orderBy('week')
            ->get()
            ->keyBy('week');
            
        // Son 6 ay için aylık chat mesajı sayısı
        $monthlyChatData = [];
        for ($i = 0; $i < 6; $i++) {
            $month = Carbon::now()->subMonths($i);
            $count = \App\Models\Message::whereHas('chat', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
                
            $monthlyChatData[$month->format('Y-m')] = $count;
        }
        
        // Son 7 gün için günlük chat mesajı sayısı
        $dailyChatData = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $count = \App\Models\Message::whereHas('chat', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->whereDate('created_at', $day->format('Y-m-d'))
                ->count();
                
            $dailyChatData[$day->format('Y-m-d')] = $count;
        }

        return view('dashboard', [
            'totalRequests' => $totalRequests,
            'dailyUsageData' => $dailyUsageData,
            'weeklyUsageData' => $weeklyUsageData,
            'dailyChatData' => $dailyChatData,
            'monthlyChatData' => $monthlyChatData,
            'totalFeedbacks' => $totalFeedbacks,
            'lastRequestDate' => $lastRequest ? $lastRequest->updated_at->format('d.m.Y H:i') : null,
            'recentComments' => $recentComments,
            'recentChats' => $recentChats,
        ]);
    }
}
