<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Payment;
use App\Models\Setting;
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

    public function Conversation(Request $request)
    {
        try {

            $setting = Setting::first();
            $getUserConvAPi = $setting->getUserConv_api;

            $account = Account::find($request->id);
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;
            $id = $account->id;

            $conversation_api = str_replace('{USERID}', $user_id, $getUserConvAPi);

            $accessToken = refreshAccessToken($refreshToken);
            
            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conversation_api}");
    
            return response()->json([
                'component' => view('admin.chat.conversation', compact('data', 'id'))->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function ConversationMessages(Request $request)
    {
        try {
            $setting = Setting::first();
            $getUserConvMsgAPi = $setting->getUserConvMsg_api;


            $account = Account::find($request->id);
            $id = $account->id;
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;
            $conv_id = $request->conv_id;

            $msg_api = str_replace('{USERID}', $user_id, $getUserConvMsgAPi);

            $conv_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);

            $accessToken = refreshAccessToken($refreshToken);


            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conv_msg_api}");
            // dd($data->json());
            $adTitle = $account->adTitle;
            $adImage = $account->adPic;
            $adPrice = $account->adPrice;
            $client_id = $data['userIdBuyer'];
            $adLink = $account->adLink;
            
            $payment = Payment::pluck('conv_id');
            if($payment){
                $available = $payment->contains($data['id']);
            }
            return response()->json([
                'component' => view('admin.chat.messages', compact('data', 'account'))->render(),
                'adTitle' => $adTitle,
                'adImage' => $adImage,
                'adPrice' => $adPrice,
                'conv_id' => $conv_id,
                'account_id' => $id,
                'client_id' => $client_id,
                'adLink' => $adLink,
                'available' => $available,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function SendMessages(Request $request)
    {
        dd(1);
        try {
            $setting = Setting::first();
            $sendMsgAPi = $setting->postMsg_api;

            $account = Account::find($request->id);
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;
            $conv_id = $request->conv_id;

            $msg_api = str_replace('{USERID}', $user_id, $sendMsgAPi);

            $send_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);

            $accessToken = refreshAccessToken($refreshToken);

            if ($request->image === 'undefined') {

                Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                    ->post(
                        "{$send_msg_api}",
                        [
                            'message' => $request->message,
                        ]
                    );
            } else {

                $file = $request->image;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path('content_media');
                $file->move($destinationPath, $fileName);
                $path = public_path('content_media/' . $fileName);

                Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                    ->attach(
                        'attachment',
                        file_get_contents($path),
                        'file.jpg'
                    )
                    ->post(
                        "{$send_msg_api}",
                        [
                            'message' => '{"message":"' . $request->message . '"}',
                        ]
                    );
            }

            return response()->json([
                'success' => 'Message Send Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }
    public function DeleteConversation(Request $request)
    {
        try {

            $setting = Setting::first();
            $getDeleteApi = $setting->delete_api;
            $getUserConvAPi = $setting->getUserConv_api;

            $account = Account::find($request->id);
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;
            $id = $account->id; 

            $user_id_replace = str_replace('{USERID}', $user_id, $getDeleteApi);
            $deleteApi = str_replace('{CONVERSATIONID}', $request->conv_id, $user_id_replace);

            $accessToken = refreshAccessToken($refreshToken);

            Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->delete("{$deleteApi}");

            $conversation_api = str_replace('{USERID}', $user_id, $getUserConvAPi);
                
            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                ->get("{$conversation_api}");
                
            return response()->json([
                'component' => view('admin.chat.conversation', compact('data', 'id'))->render(),
                'success' => 'Chat deleted Successfully.'
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
                    'error' => 'Account not found!',
                ]);
            }
        }
    }
    public function ReloadAccount()
    {
        if (Auth::user()->role == 'admin') {
            $accounts_reload = Account::all();
        } else {
            $accounts_reload = Account::where('buy_id', Auth::user()->id)->get();
        }
        if ($accounts_reload) {
            $setting = Setting::first();
            $authorization = $setting->getUser_header_api;
            $getUserApi = $setting->getUser_api;

            foreach ($accounts_reload as $account) {

                $data = $account->description;
                $parts = explode(':', $data);
                $email = $parts[0];

                $getUser_api = str_replace('{USERID}', $account->account_id, $getUserApi);

                $accessToken = refreshAccessToken($account->refreshToken);
   
                if($accessToken['accessToken'] != null){
                    $data = Http::withHeaders([
                        'User-Agent' => '',
                        'Authorization' => $authorization,
                        'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken['accessToken'] . '"'
                    ])->get("{$getUser_api}");
    
                    $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];
    
                    $adPrice = $adData['price']['amount']['value'];
                    $adTitle = $adData['title']['value'];
                    $reloadDate = $adData['last-user-edit-date']['value'];
                    $status = $adData['ad-status']['value'];
    
                    $pictureLink = null;
                    if (isset($adData['pictures']['picture'][0]['link'][0]['href'])) {
                        $pictureLink = $adData['pictures']['picture'][0]['link'][0]['href'];
                    }
    
                    $account = Account::find($account->id);
                    $account->adTitle = $adTitle;
                    $account->adPic = $pictureLink;
                    $account->adPrice = $adPrice;
                    $account->adStatus = $status;
                    $account->reloadDate = $reloadDate;
                    $account->save();
                }else{
                    $account = Account::find($account->id);
                    $account->adStatus = '';
                    $account->save();
                }                
            }
            if (Auth::user()->role == 'admin') {
                $accounts = Account::all();
            } else {
                $accounts = Account::where('buy_id', Auth::user()->id)->get();
            }
            return response()->json([
                'component' => view('admin.chat.accounts', compact('accounts'))->render(),
            ]);
        } else {
            return response()->json([
                'error' => 'Account not found.',
            ]);
        }
    }
}
