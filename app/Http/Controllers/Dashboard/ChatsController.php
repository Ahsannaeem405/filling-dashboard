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
        if(Auth::user()->role === 'user'){
            $accounts = Account::where('buy_id',Auth::user()->id)->get();
        }else{
            $accounts = Account::all();
        }
        return view('admin.chat.index',compact('accounts'));
    }

    private function refreshAccessToken($refreshToken,$domain)
    {
        $response = Http::withHeaders(['User-Agent' => ''])->post("https://gateway.kleinanzeigen.de/auth/refresh", [
            'refreshToken' => $refreshToken,
        ]);
        dd($response->json());
        return [
            'accessToken' => $response['accessToken'],
        ];
    }

    public function Conversation(Request $request)
    {
        $url = Setting::first();
        $domain = $url->site_url;

        $accessToken = $this->refreshAccessToken($request->refreshToken,$domain);
        
        $refreshToken = $request->refreshToken;

        $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->get("{$domain}/messagebox/api/users/{$request->user_id}/conversations?size=100000000");

        return response()->json([
            'component' => view('admin.chat.conversation',compact('data','refreshToken'))->render(),
        ]);
    }

    public function ConversationMessages(Request $request)
    {
        $url = Setting::first();
        $domain = $url->site_url;
        
        $accessToken = $this->refreshAccessToken($request->refreshToken,$domain);
        $refreshToken = $request->refreshToken;
        $conv_id = $request->conv_id;
        $user_id = $request->user_id;

        $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->get("{$domain}/messagebox/api/users/{$request->user_id}/conversations/{$request->conv_id}");
        $name = $data['buyerName'];
        $logo = $data['buyerInitials'];

        return response()->json([
            'component' => view('admin.chat.messages',compact('data','refreshToken'))->render(),
            'name' => $name,
            'logo' => $logo,
            'conv_id' => $conv_id,
            'user_id' => $user_id,
            'refreshToken' => $refreshToken

        ]);
    }

    public function SendMessages(Request $request)
    {
        $url = Setting::first();
        $domain = $url->site_url;
        
        $accessToken = $this->refreshAccessToken($request->refreshToken,$domain);

        Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->post("{$domain}/messagebox/api/users/{$request->user_id}/conversations/{$request->conv_id}?warnBankDetails=1&warnEmail=1&warnPhoneNumber=1",
            [
                'message' => $request->message,
        ]);

        return response()->json([
            'success' => 'Message Send Successfully',
        ]);
    }

    public function AssignAccount(Request $request)
    {
        $limit = Auth::user()->limit;

        $count = Account::where('buy_id',Auth::user()->id)->where('buy_date',today())->count();
        

        if($count >= $limit){
            return back()->with('error','Accounts limit are reached!');
        }else{
            $account = Account::whereNull('buy_id')->first();

            if($account){
                $account->buy_id = Auth::user()->id;
                $account->buy_date = now()->toDateString();;
                $account->save();
                $accounts = Account::where('buy_id',Auth::user()->id)->get();
                return response()->json([
                    'component' => view('admin.chat.accounts',compact('accounts'))->render(),
                    'success' => 'Account assign Successfully',        
                ]);
                return back()->with('success','Account assign Successfully');
            }else{
                return back()->with('error','Accounts are not available!');
            }
        }
        
    }
}
