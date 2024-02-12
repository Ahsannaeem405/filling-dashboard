<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\ReplyMail;
use App\Models\Account;
use App\Models\Conversation;
use App\Models\Messages;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Facades\Client;

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

//            $conversation_api = str_replace('{USERID}', $user_id, $getUserConvAPi);
//
//            $accessToken = refreshAccessToken($refreshToken, $account->id);
//
//            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->get("{$conversation_api}");
            $data = Conversation::whereAccountId($account->id)->get();
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

//            $msg_api = str_replace('{USERID}', $user_id, $getUserConvMsgAPi);
//
//            $conv_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);
//
//            $accessToken = refreshAccessToken($refreshToken, $account->id);
//
//
//            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->get("{$conv_msg_api}");

            $data = Messages::whereConversationId($conv_id)->get();
            Messages::whereConversationId($conv_id)->where('seen', 'unseen')->update(['seen' => 'seen']);
            $adTitle = $account->adTitle;
            $adImage = $account->adPic;
            $adPrice = $account->adPrice;
            $client_id = $conv_id;
            $adLink = $account->adLink;

            $paypal = Payment::where('user_id', Auth::user()->id)->where('payment_method', 'paypal')->pluck('conv_id');
            $bank = Payment::where('user_id', Auth::user()->id)->where('payment_method', 'bank')->pluck('conv_id');
            if ($paypal) {
                $paypal = $paypal->contains($conv_id);
            }
            if ($bank) {
                // $bank = $bank->contains($data['id']);
                $bank = $bank->contains($conv_id);
            }
            return response()->json([
                'component' => view('admin.chat.messages', compact('data', 'account', 'conv_id', 'account'))->render(),
                'adTitle' => $adTitle,
                'adImage' => $adImage,
                'adPrice' => $adPrice,
                'conv_id' => $conv_id,
                'account_id' => $id,
                'client_id' => $client_id,
                'adLink' => $adLink,
                'paypal' => $paypal,
                'bank' => $bank,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function SendMessages(Request $request)
    {

        try {
            $setting = Setting::first();
            $sendMsgAPi = $setting->postMsg_api;
            $getUserConvAPi = $setting->getUserConv_api;

            $account = Account::find($request->id);
            $accountData = explode(':', $account->description);

            $unreadCounts = [];


            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;

            $conv_id = Conversation::find($request->conv_id);

//            $msg_api = str_replace('{USERID}', $user_id, $sendMsgAPi);
//
//            $send_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);
//
//            $conversation_api = str_replace('{USERID}', $user_id, $getUserConvAPi);
//
//            $accessToken = refreshAccessToken($refreshToken, $account->id);
//
//            if ($request->image === 'undefined') {
//
//                $response = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                    ->post(
//                        "{$send_msg_api}",
//                        [
//                            'message' => $request->message,
//                        ]
//                    );
//            } else {
//
//                $file = $request->image;
//                $fileName = $file->getClientOriginalName();
//                $destinationPath = public_path('content_media');
//                $file->move($destinationPath, $fileName);
//                $path = public_path('content_media/' . $fileName);
//
//                $response = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                    ->attach(
//                        'attachment',
//                        file_get_contents($path),
//                        'file.jpg'
//                    )
//                    ->post(
//                        "{$send_msg_api}",
//                        [
//                            'message' => '{"message":"' . $request->message . '"}',
//                        ]
//                    );
//            }
//            if ($response->json() !== null) {
//
//                $conversation_data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                    ->get("{$conversation_api}");
//                $unreadCounts[$account->id] = $conversation_data['numUnread'] ?? 0;
//
//            }

            config([
                'mail.mailers.smtp.host' => 'smtp.web.de',
                'mail.mailers.smtp.port' => 465,
                'mail.mailers.smtp.encryption' => 'ssl',
                'mail.mailers.smtp.username' => $accountData[0],
                'mail.mailers.smtp.password' => $accountData[1],
                'mail.from.address' => $accountData[0],
            ]);
            $attributes = ['message' => $request->message];
            $fileData = array();
            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path('content_media');
                $file->move($destinationPath, $fileName);
                $path = public_path('content_media/' . $fileName);
                $fileData[] = 'content_media/' . $fileName;
                $attributes['image'] = $path;
            }
            Mail::to($conv_id->from)->send(new ReplyMail($attributes));
            Messages::create([
                'conversation_id' => $conv_id->id,
                'seen' => 'seen',
                'message' => $request->message,
                'account_id' => $conv_id->account_id,
                'from' => $conv_id->account->getEmail(),
                'to' => $conv_id->from,
                'image' => $fileData,
            ]);

            return response()->json([
                'success' => 'Message Send Successfully',
                'unread' => $unreadCounts,
                'account_id' => $account->account_id
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

//            $user_id_replace = str_replace('{USERID}', $user_id, $getDeleteApi);
//            $deleteApi = str_replace('{CONVERSATIONID}', $request->conv_id, $user_id_replace);
//
//            $accessToken = refreshAccessToken($refreshToken, $account->id);
//
//            Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->delete("{$deleteApi}");
//
//            $conversation_api = str_replace('{USERID}', $user_id, $getUserConvAPi);
//
//            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->get("{$conversation_api}");

            Conversation::find($request->conv_id)->delete();
            Messages::whereConversationId($request->conv_id)->delete();

            $data = Conversation::whereAccountId($account->id)->get();

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
            $account = Account::whereNull('buy_id')->where('adStatus', 'ACTIVE')->first();

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

    public function ReAssignAccount(Request $request)
    {
        Account::where('id', $request->id)->update([
            'buy_id' => null,
            'buy_date' => null,
        ]);
        $limit = Auth::user()->limit;

        $count = Account::where('buy_id', Auth::user()->id)->where('buy_date', today())->count();
        $accounts = Account::whereNot('id', $request->id)->where('buy_id', Auth::user()->id)->get();

        if ($count >= $limit) {
            return response()->json([
                'component' => view('admin.chat.accounts', compact('accounts'))->render(),
                'error' => 'Accounts limit are reached!',
            ]);
        } else {
            $account = Account::whereNot('id', $request->id)->whereNull('buy_id')->where('adStatus', 'ACTIVE')->first();

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
            $getUserConvAPi = $setting->getUserConv_api;
            $getUserApi = $setting->getUser_api;
            $unreadCounts = [];

            foreach ($accounts_reload as $account) {


                $data = $account->description;
                $parts = explode(':', $data);
                $email = $parts[0];

                $getUser_api = str_replace('{USERID}', $account->account_id, $getUserApi);
                $conversation_api = str_replace('{USERID}', $account->account_id, $getUserConvAPi);

                $accessToken = refreshAccessToken($account->refreshToken, $account->id);

                if ($accessToken['accessToken'] != null) {

                    $conversation_data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
                        ->get("{$conversation_api}");

                    $unreadCounts[$account->id] = $conversation_data['numUnread'] ?? 0;

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
                } else {
                    $account = Account::find($account->id);
                    $account->adStatus = NULL;
                    $account->save();
                }
            }
            if (Auth::user()->role == 'admin') {
                $accounts = Account::all();
            } else {
                $accounts = Account::where('buy_id', Auth::user()->id)->get();
            }
            return response()->json([
                'component' => view('admin.chat.accounts', compact('accounts', 'unreadCounts'))->render(),
            ]);
        } else {
            return response()->json([
                'error' => 'Account not found.',
            ]);
        }
    }

    public function DeleteInactive()
    {
        if (Auth::user()->role == 'admin') {
            $inactive_accounts = Account::where('adStatus', NULL)->get();
        } else {
            $inactive_accounts = Account::where('buy_id', Auth::user()->id)->where('adStatus', NULL)->get();
        }
        if ($inactive_accounts->count() > 0) {

            foreach ($inactive_accounts as $account) {
                $account->delete();
            }

            if (Auth::user()->role == 'admin') {
                $accounts = Account::all();
            } else {
                $accounts = Account::where('buy_id', Auth::user()->id)->get();
            }
            return response()->json([
                'component' => view('admin.chat.accounts', compact('accounts'))->render(),
                'success' => 'Successfully deleted all invalid accounts.',
            ]);
        } else {
            return response()->json([
                'error' => 'There is no invalid account.',
            ]);
        }
    }

    public function testImap()
    {
        //test
        $accounts = Account::where('adStatus', 'ACTIVE')->get();
        foreach ($accounts as $account) {
            try {
                $data = explode(':', $account->description);
                $client = Client::make([
                    'host' => 'imap.web.de',
                    'port' => 993,
                    'encryption' => 'ssl',
                    'validate_cert' => true,
                    'username' => $data[0],
                    'password' => $data[1],
                    'protocol' => 'imap'
                ]);
                $client->connect();

                $inbox = $client->getFolder('INBOX'); //INBOX,Spam
                $newMessages = $inbox->query()->unseen()->all()->get();


                foreach ($newMessages as $message) {
                $paths = array();
                    if (strpos($message->getSubject()->toString(), 'Nutzer-Anfrage') !== false) {
                        $conversation = Conversation::firstOrCreate([
                            'from' => $message->getFrom()->toArray()[0]->mail,
                            'to' => $message->getTo()->toArray()[0]->mail,
                            'account_id' => $account->id
                        ]);
                        $pattern = '/<b>Nachricht von:<\/b>(.*?)\r/';
                        if (preg_match($pattern, $message->getHTMLBody(), $matches)) {
                            $extractedText = $matches[1];
                            $conversation->name = $extractedText;
                            $conversation->update();
                        }
                        if ($message->hasAttachments()) {
                            foreach ($message->getAttachments() as $attachment) {
                                $publicPath = public_path('content_media');
                                $savePath = $publicPath . '/' . $attachment->getName();
                                file_put_contents($savePath, $attachment->getContent());
                                $paths[] = 'content_media/'.$attachment->getName();
                            }
                        }
                        Messages::create([
                            'conversation_id' => $conversation->id,
                            'from' => $message->getFrom()->toArray()[0]->mail,
                            'to' => $message->getTo()->toArray()[0]->mail,
                            'message' => $message->getTextBody(),
                            'subject' => $message->getSubject()->toString(),
                            'account_id' => $account->id,
                            'image' => $paths
                        ]);
                        // $message->setFlag('seen');
                    }
                }
                $client->disconnect();
            } catch (\Throwable $exception) {
                dd($exception);
                $account->update(['adStatus' => null]);
            }
        }


    }
}
