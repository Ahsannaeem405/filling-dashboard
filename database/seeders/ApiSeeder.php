<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'accessToken_api' => 'https://gateway.kleinanzeigen.de/auth/refresh',
            'getUser_api' => 'https://api.kleinanzeigen.de/api/users/{USERID}/ads.json?page=0&size=30',
            'getUserConv_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations?size=100000000',
            'getUserConvMsg_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations/{CONVERSATIONID}',
            'postMsg_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations/{CONVERSATIONID}?warnBankDetails=1&warnEmail=1&warnPhoneNumber=1',
        ]);
    }
}
