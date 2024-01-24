<?php

use App\Models\Account;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

function refreshAccessToken($refreshToken,$Account_id=0)
{
    try {
        if($Account_id != 0){
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
            'http'  => $proxyUrl,
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

    $accessToken = refreshAccessToken($refreshToken,$account->id);

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
