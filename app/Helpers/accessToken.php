<?php

use App\Models\Account;
use App\Models\Conversation;
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
                        $paths[] = 'content_media/' . $attachment->getName();
                    }
                }

                $messageData = $message->getTextBody();
                if (strpos($message->getTextBody(), $account->adId) !== false) {
                    // Use regular expression to get text after the specific ID
                    //dd(explode($account->adId.':',$messageData));
                    $pattern = "/{$account->adId}:\s*(.*)/";
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
        $client->disconnect();
    } catch (\Throwable $exception) {
        $account->update(['adStatus' => null]);
    }
}
