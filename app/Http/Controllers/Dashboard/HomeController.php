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
            $count = $accounts->count();
        } else {
            $accounts = Account::all();
            $count = $accounts->count();
        }
        
        $users = User:: whereNot('role', 'admin')->orderBy('rank', 'DESC')->take(7)->get();
        $users = $users->sortByDesc('rank');

        $totalChat = 0;
        $totalUnread = 0;
        $completeChat = 0;

        try{    
            $setting = Setting::first();
            $getUserConvAPi = $setting->getUserConv_api;
    
            foreach ($accounts as $account) {

                $conversation_api = str_replace('{USERID}', $account->account_id, $getUserConvAPi);

                $accessToken = refreshAccessToken($account->refreshToken);

                $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conversation_api}");
    
                $totalChat += count($data['conversations']);
                $totalUnread += $data['_meta']['numUnread'];
            }
            
            $completeChat = $totalChat - $totalUnread;
    
            return view('admin.index', compact('totalChat', 'users','totalUnread','completeChat'));
        } catch (\Exception $e) {
            $totalChat = 'Something went wrong!';
            $totalUnread = 'Something went wrong!';
            $completeChat = 'Something went wrong!';
            return view('admin.index', compact('totalChat', 'users','totalUnread','completeChat'));
        }   
    }
}
