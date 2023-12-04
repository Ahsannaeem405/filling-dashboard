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
    /**
     * Display a listing of the resource.
     */
    private function refreshAccessToken($refreshToken, $domain)
    {
        try {
            $response = Http::withHeaders(['User-Agent' => ''])->post("{$domain}/auth/refresh", [
                'refreshToken' => $refreshToken,
            ]);
            return [
                'accessToken' => $response['accessToken'],
            ];
        } catch (\Exception $e) {
            return [
                'accessToken' => null,
            ];
        }
    }
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $accounts = Account::where('buy_id', Auth::user()->id)->get();
            $count = $accounts->count();
        } else {
            $accounts = Account::all();
            $count = $accounts->count();
        }
        
        $users = User::whereNot('id', Auth::user()->id)->whereNot('role', 'admin')->latest()->take(5)->get();

        $totalChat = 0;
        $totalUnread = 0;
        $completeChat = 0;

        try{    
            $url = Setting::first();
            $domain = $url->site_url;
    
            foreach ($accounts as $account) {
                $accessToken = $this->refreshAccessToken($account->refreshToken, $domain);
    
                $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                    ->get("{$domain}/messagebox/api/users/{$account->account_id}/conversations?size=100000000");
    
                $totalChat += $data['_meta']['numFound'];
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
