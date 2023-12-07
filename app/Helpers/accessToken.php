<?php

use App\Models\Account;
use Illuminate\Support\Facades\Http;

function refreshAccessToken($refreshToken, $accessTokenApi)
{
    $account = Account::where('refreshToken', $refreshToken)->first();

    if ($account) {
        $currentTime = now();
        $tokenCreationTime = $account->created_at;

        if ($tokenCreationTime && $currentTime->diffInMinutes($tokenCreationTime) < 30) {
            return [
                'accessToken' => $account->accessToken,
            ];
        }
    }
    try {
        $response = Http::withHeaders(['User-Agent' => ''])->post($accessTokenApi, [
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

?>