<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'user') {
            $accounts = Account::where('buy_id', Auth::user()->id)->get();
        } else {
            $accounts = Account::all();
        }

        $users = User::whereNot('role', 'admin')->orderBy('rank', 'DESC')->take(7)->get();
        $users = $users->sortByDesc('rank');

        $user = Auth::user();
        $countsChats = json_decode($user->counts_chats);

        $totalChat = $countsChats->totalChat ?? 0;
        $totalUnread = $countsChats->totalUnread ?? 0;
        $completeChat = $countsChats->completeChat ?? 0;

        return view('admin.index', compact('totalChat', 'users', 'totalUnread', 'completeChat'));
    }
    public function Count()
    {
        if (Auth::user()->role === 'user') {
            $accounts = Account::where('buy_id', Auth::user()->id)->get();
        } else {
            $accounts = Account::all();
        }

        $totalChat = 0;
        $totalUnread = 0;
        $completeChat = 0;

        $setting = Setting::first();
        $getUserConvAPi = $setting->getUserConv_api;

        foreach ($accounts as $account) {

//            $conversation_api = str_replace('{USERID}', $account->account_id, $getUserConvAPi);
//
//            $accessToken = refreshAccessToken($account->refreshToken, $account->id);
//
//            if($accessToken['accessToken'] != null){
//                $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->get("{$conversation_api}");
//                if ($data !== null) {
                    $totalChat += count($account->conversation);
                    $totalUnread += $account->unRead();
//                }
//            }

        }

        $completeChat = $totalChat - $totalUnread;

        $counts_chats = [
            'totalChat' => $totalChat,
            'totalUnread' => $totalUnread,
            'completeChat' => $completeChat,
        ];

        $user = User::find(Auth::user()->id);
        $user->counts_chats = $counts_chats;
        $user->save();
        return response()->json([
            'totalChat' => $totalChat,
            'totalUnread' => $totalUnread,
            'completeChat' => $completeChat,
            'success' => 'Chats stats updated',
        ]);
    }
}
