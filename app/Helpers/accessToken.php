<?php

use App\Models\Account;
use App\Models\Conversation;
use App\Models\Mail_Setting;
use App\Models\Messages;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Webklex\IMAP\Facades\Client;

function refreshAccessToken($refreshToken, $Account_id = 0)
{
    try {
        if ($Account_id != 0) {
            $account = Account::find($Account_id);
        }

        $setting = Setting::first();
        $accessTokenApi = $setting->accessToken_api;

        if (isset($account)) {
            $currentTime = now();
            $tokenCreationTime = $account->created_at;

            if ($tokenCreationTime && $currentTime->diffInMinutes($tokenCreationTime) < 30) {
                return [
                    'accessToken' => $account->accessToken,
                    'proxy' => $account->proxy,
                ];
            }
        }
        $randomProxy = Str::random(8);

        $proxyUrlTemplate = 'http://rotating.proxyempire.io:5000:package-10001-country-de-sessionid-[[RANDOM_SESSION]]-sessionlength-3600:aq6VTDNdd4jwrb5n';

        $proxyUrl = str_replace('[[RANDOM_SESSION]]', $randomProxy, $proxyUrlTemplate);

        $proxies = [
            'http' => $proxyUrl,
        ];

        $response = Http::withCookies(['refresh_token' => $refreshToken], 'www.kleinanzeigen.de')
            ->withHeaders([
                'User-Agent' => '',
            ])
            ->withOptions([
                'proxy' => $proxies,
            ])
            ->get($accessTokenApi);

        $cookieJar = $response->cookies();
        $accessTokenCookie = $cookieJar->getCookieByName('access_token');
        $refreshTokenCookie = $cookieJar->getCookieByName('refresh_token');
        // dd($accessTokenCookie->getValue(),$refreshTokenCookie->getValue());

        // $response = Http::withHeaders([
        //     'User-Agent' => '',
        //     'Authorization' => $authorization,
        // ])->post($accessTokenApi, [
        //     'refreshToken' => $refreshToken,
        // ]);

        if (isset($account)) {
            $account->update([
                'accessToken' => $accessTokenCookie->getValue(),
                'refreshToken' => $refreshTokenCookie->getValue(),
                'proxy' => $randomProxy,
                'created_at' => now(),
            ]);
        }
        return [
            'accessToken' => $accessTokenCookie->getValue(),
            'proxy' => $randomProxy,
        ];
    } catch (\Throwable $e) {
        return [
            'accessToken' => null,
            'proxy' => null,
        ];
    }
}

function showImage($url, $id)
{

    $setting = Setting::first();
    $authorization = $setting->image_header_api;

    $account = Account::find($id);
    $refreshToken = $account->refreshToken;
    $data = $account->description;
    $parts = explode(':', $data);
    $email = $parts[0];

    $accessToken = refreshAccessToken($refreshToken, $account->id);

    $response = Http::withHeaders([
        'User-Agent' => '',
        'Authorization' => $authorization,
        'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken['accessToken'] . '"'
    ])->get($url);

    if ($response->successful()) {
        $imageContents = $response->body();
        $base64Image = base64_encode($imageContents);

        return "data:image/jpeg;base64," . $base64Image;
    } else {
        throw new \Exception("API request failed for URL: $url with status code: {$response->status()}. Body: {$response->body()}");
    }
}

function RefreshAccount($account)
{
    try {
        $data = explode(':', $account->description);
        
        $email = explode('@', $data[0]);
        $account_host = $email[1];
        $mail = Mail_Setting::where('host', $account_host)->first();
        $host = $mail->get_host . '.' . $mail->host;
        $port = $mail->get_port;
        $encryption = $mail->get_encryption;
        
        $client = Client::make([
            'host' => $host,
            'port' => $port,
            'encryption' => $encryption,
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
            if (strpos($message->getSubject()->toString(), 'Nutzer-Anfrage') !== false || strpos($message->getSubject()->toString(), 'Re:') !== false) {
                if(strpos($message->getSubject()->toString(), $account->adTitle) !== false){
                    
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
                            $paths[] = 'content_media/' . $attachment->getName();
                        }
                    }
    
                    $messageData = $message->getTextBody();
    
                    if (strpos($message->getTextBody(), $account->adId) !== false) {
                        // Use regular expression to get text after the specific ID
                        //dd(explode($account->adId.':',$messageData));
                        // $pattern = "/{$account->adId}:\s*(.*)/";
                        $pattern = "/{$account->adId}:(.*?)(?:\n\n|\z)/s";
                        
                        preg_match($pattern, $message->getTextBody(), $matches);
    
    
                        if (isset($matches[1])) {
                            $textAfterId = trim($matches[1]);
                            $messageData = $textAfterId;
    
                        }
                    }
    
    
                    Messages::create([
                        'conversation_id' => $conversation->id,
                        'from' => $message->getFrom()->toArray()[0]->mail,
                        'to' => $message->getTo()->toArray()[0]->mail,
                        'message' => $messageData,
                        'subject' => $message->getSubject()->toString(),
                        'account_id' => $account->id,
                        'image' => $paths
                    ]);
                    $message->setFlag('seen');   
                }
            }
        }
        $client->disconnect();
        $account->update([
            'imap' => '0'
        ]);
    } catch (\Throwable $exception) {
        $account->update([
            'adStatus' => null,
            'imap' => '1'
        ]);
    }
}
function UpdateSingleAccount($account_id)
{   
    try {
        $account = Account::find($account_id);
        $data = $account->description;

        $setting = Setting::first();
        $getUserApi = $setting->getUser_api;
        $authorization = $setting->getUser_header_api;

        $account_id = null;
        $parts = explode(':', $data);
        $account_id = $parts[2];
   
        $email = explode('@', $parts[0]);
        $host = $email[1];
        $check_host = Mail_Setting::where('host', $host)->first();
        if ($check_host) {
            $getUser_api = str_replace('{{AD_ID}}', $account_id, $getUserApi);

            $data = Http::withHeaders([
                'User-Agent' => '',
                'Authorization' => $authorization
            ])->get("{$getUser_api}");

            $response = $data->json();

            if ($data->status()==200) {
                $adData = $response['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ad']['value'];

                $price = $adData['price']['amount']['value'] ?? 0;
                $title = $adData['title']['value'];
                $reloadDate = $adData['last-user-edit-date']['value'];
                $name = $adData['contact-name']['value'];
                $data = $adData['ad-status']['value'];
                if ($data === 'ACTIVE') {
                    $status = $data;
                } else {
                    $status = null;
                }

                $linkArray = $adData['link'];

                $link = null;
                foreach ($linkArray as $link) {
                    if (isset($link['rel']) && $link['rel'] === 'self-public-website') {
                        $link = $link['href'];
                        break;
                    }
                }

                $pictureLink = null;
                if (isset($adData['pictures']['picture'][0]['link'][0]['href'])) {
                    $pictureLink = $adData['pictures']['picture'][0]['link'][0]['href'];
                }
                $account->account_id = $account_id;
                $account->adPic = $pictureLink;
                $account->name = $name;
                $account->adLink = $link;
                $account->adTitle = $title;
                $account->adPrice = $price;
                $account->adStatus = $status;
                $account->reloadDate = $reloadDate;
                $account->adId = $adData['id'];
                $account->save();
            } else {
                $account->adStatus = null;
                $account->save();
            }
        } 
        return [
            'status' => $account->adStatus,
            'imap' => $account->imap,
        ];
    } catch (\Exception $e) {
        return [
            'status' => ' ',
        ];
    }
}