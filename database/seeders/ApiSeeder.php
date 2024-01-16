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
            'accessToken_api' => 'https://www.kleinanzeigen.de/m-access-token.json',
            'accessToken_header_api' => 'Basic aXBob25lOmc0Wmk5cTEw',
            'getUser_api' => 'https://api.kleinanzeigen.de/api/users/{USERID}/ads.json?page=0&size=30',
            'getUser_header_api' => 'Basic aXBob25lOmc0Wmk5cTEw',
            'getUserConv_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations?size=100000000',
            'getUserConvMsg_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations/{CONVERSATIONID}',
            'getUserConvImg_api' => 'https://api.ebay-kleinanzeigen.de/api/users/{USERID}/conversation-attachments?messageId=a1c5f777-98cc-11ee-a0e7-253d5d1525d5&filename=ek-yams-ec59bf5b886f4e49984540060b7bd7f1-543ED900-BA56-4219-BF13-BF132A5AD4BE.jpg',
            'image_header_api' => 'Basic aXBob25lOmc0Wmk5cTEw',
            'postMsg_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations/{CONVERSATIONID}?warnBankDetails=1&warnEmail=1&warnPhoneNumber=1',
            'delete_api' => 'https://gateway.kleinanzeigen.de/messagebox/api/users/{USERID}/conversations?ids={CONVERSATIONID}',
        ]);
    }
}
