<?php

use App\Models\Account;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

function refreshAccessToken($refreshToken)
{
    try {
        $account = Account::where('refreshToken', $refreshToken)->first();

        $setting = Setting::first();
        $accessTokenApi = $setting->accessToken_api;
        $authorization = $setting->accessToken_header_api;

        if ($account) {
            $currentTime = now();
            $tokenCreationTime = $account->created_at;

            if ($tokenCreationTime && $currentTime->diffInMinutes($tokenCreationTime) < 30) {
                return [
                    'accessToken' => $account->accessToken,
                ];
            }
        }
        $response = Http::withHeaders([
            'User-Agent' => '',
            'Authorization' => $authorization,
        ])->post($accessTokenApi, [
            'refreshToken' => $refreshToken,
        ]);

        if ($account) {
            $account->update([
                'accessToken' => $response['accessToken'],
                'created_at' => now(),
            ]);
        }
        return [
            'accessToken' => $response['accessToken'],
        ];
    } catch (\Exception $e) {
        return [
            'accessToken' => null,
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

    $accessToken = refreshAccessToken($refreshToken);

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
