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

    private function refreshAccessToken($refreshToken, $accessTokenApi)
    {
        try {
            $response = Http::withHeaders(['User-Agent' => ''])->post("{$accessTokenApi}", [
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
            
            $setting = Setting::first();
            $accessTokenApi = $setting->accessToken_api;
            $getUserConvAPi = $setting->getUserConv_api;

            $conversation_api = str_replace('{USERID}', $request->user_id, $getUserConvAPi);

            $accessToken = $this->refreshAccessToken($request->refreshToken, $accessTokenApi);
            $refreshToken = $request->refreshToken;

            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conversation_api}");
              
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
            $setting = Setting::first();
            $accessTokenApi = $setting->accessToken_api;
            $getUserConvMsgAPi = $setting->getUserConvMsg_api;

            $msg_api = str_replace('{USERID}', $request->user_id, $getUserConvMsgAPi);

            $conv_msg_api = str_replace('{CONVERSATIONID}', $request->conv_id, $msg_api);

            $accessToken = $this->refreshAccessToken($request->refreshToken, $accessTokenApi);

            $refreshToken = $request->refreshToken;
            $conv_id = $request->conv_id;
            $user_id = $request->user_id;

            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conv_msg_api}");
            $buyerName = $data['buyerName'];
            $buyerInitials = $data['buyerInitials'];
            $adTitle = $data['adTitle'];
            $ad = $data['adImage'];
            $adImage = str_replace('{imageId}', 0, $ad);
            
            $price = $data['adPriceInEuroCent'];
            $adPrice = $price / 100;

            return response()->json([
                'component' => view('admin.chat.messages', compact('data', 'refreshToken'))->render(),
                'buyerName' => $buyerName,
                'buyerInitials' => $buyerInitials,
                'adTitle' => $adTitle,
                'adImage' => $adImage,
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
            $setting = Setting::first();
            $accessTokenApi = $setting->accessToken_api;
            $sendMsgAPi = $setting->postMsg_api;

            $msg_api = str_replace('{USERID}', $request->user_id, $sendMsgAPi);

            $send_msg_api = str_replace('{CONVERSATIONID}', $request->conv_id, $msg_api);

            $accessToken = $this->refreshAccessToken($request->refreshToken, $accessTokenApi);

            Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->post("{$send_msg_api}",
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
