<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatsController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'user') {
            $accounts = Account::where('buy_id', Auth::user()->id)->get();
        } else {
            $accounts = Account::all();
        }
        return view('admin.chat.index', compact('accounts'));
    }

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

    public function Conversation(Request $request)
    {
       
        try {
            
            $url = Setting::first();
            $domain = $url->site_url;

            $accessToken = $this->refreshAccessToken($request->refreshToken, $domain);

            $refreshToken = $request->refreshToken;

            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$domain}/messagebox/api/users/{$request->user_id}/conversations?size=100000000");
            $numFound = $data['_meta']['numFound'];
            $numUnread = $data['_meta']['numUnread'];

            return response()->json([
                'component' => view('admin.chat.conversation', compact('data', 'refreshToken'))->render(),
            ]);
        } catch (\Exception $e) {
        
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function ConversationMessages(Request $request)
    {
        try {
            $url = Setting::first();
            $domain = $url->site_url;

            $accessToken = $this->refreshAccessToken($request->refreshToken, $domain);
            $refreshToken = $request->refreshToken;
            $conv_id = $request->conv_id;
            $user_id = $request->user_id;

            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$domain}/messagebox/api/users/{$request->user_id}/conversations/{$request->conv_id}");
            $buyerName = $data['buyerName'];
            $buyerInitials = $data['buyerInitials'];
            $adTitle = $data['adTitle'];
            $price = $data['adPriceInEuroCent'];
            $adPrice = $price / 100;

            return response()->json([
                'component' => view('admin.chat.messages', compact('data', 'refreshToken'))->render(),
                'buyerName' => $buyerName,
                'buyerInitials' => $buyerInitials,
                'adTitle' => $adTitle,
                'adPrice' => $adPrice,
                'conv_id' => $conv_id,
                'user_id' => $user_id,
                'refreshToken' => $refreshToken

            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function SendMessages(Request $request)
    {
        try {
            $url = Setting::first();
            $domain = $url->site_url;

            $accessToken = $this->refreshAccessToken($request->refreshToken, $domain);

            Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->post(
                    "{$domain}/messagebox/api/users/{$request->user_id}/conversations/{$request->conv_id}?warnBankDetails=1&warnEmail=1&warnPhoneNumber=1",
                    [
                        'message' => $request->message,
                    ]
                );

            return response()->json([
                'success' => 'Message Send Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function AssignAccount(Request $request)
    {
        $limit = Auth::user()->limit;

        $count = Account::where('buy_id', Auth::user()->id)->where('buy_date', today())->count();
        $accounts = Account::where('buy_id', Auth::user()->id)->get();

        if ($count >= $limit) {
            return response()->json([
                'component' => view('admin.chat.accounts', compact('accounts'))->render(),
                'error' => 'Accounts limit are reached!',
            ]);
        } else {
            $account = Account::whereNull('buy_id')->first();

            if ($account) {
                $account->buy_id = Auth::user()->id;
                $account->buy_date = now()->toDateString();;
                $account->save();
                $accounts = Account::where('buy_id', Auth::user()->id)->get();
                return response()->json([
                    'component' => view('admin.chat.accounts', compact('accounts'))->render(),
                    'success' => 'Account assign Successfully',
                ]);
            } else {
                return response()->json([
                    'component' => view('admin.chat.accounts', compact('accounts'))->render(),
                    'error' => 'Accounts not empty!',
                ]);
            }
        }
    }
    public function ReloadAccount()
    {
        $accounts = Account::where('buy_id', Auth::user()->id)->get();
        return response()->json([
            'component' => view('admin.chat.accounts', compact('accounts'))->render(),
        ]);
    }
}
