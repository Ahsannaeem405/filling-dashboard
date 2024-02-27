<?php

namespace App\Http\Controllers;

use App\Imports\AccountImport;
use App\Models\Account;
use App\Models\Mail_Setting;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function Account()
    {
        $accounts = Account::all();
        return view('admin.accounts.index', compact('accounts'));
    }
    public function CreateAccount()
    {
        return view('admin.accounts.create');
    }
    public function StoreAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);

        $validAccountsCount = 0;
        $invalidAccountsCount = 0;

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $data = $request->description;

            // $refreshToken = null;
            // $jsonString = substr($data, strpos($data, '['));
            // $jsonArray = json_decode($jsonString, true);
            // if ($jsonArray) {
            //     foreach ($jsonArray as $item) {
            //         if (isset($item['name']) && $item['name'] === 'refresh_token') {
            //             $refreshToken = $item['value'];
            //             break;
            //         }
            //     }
            // }
            // $account_id = null;
            // $userIdPattern = '/:(\d+):/';
            // if (preg_match($userIdPattern, $data, $userIdMatches)) {
            //     $account_id = $userIdMatches[1];
            // }

            // $parts = explode(':', $data);
            // $email = $parts[0];

            // $response = refreshAccessToken($refreshToken,0);

            // $accessToken = $response['accessToken'];
            // $proxy = $response['proxy'];

            // $data = Http::withHeaders([
            //     'User-Agent' => '',
            //     'Authorization' => $authorization,
            //     'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            // ])->get("{$getUser_api}");


            $setting = Setting::first();
            $getUserApi = $setting->getUser_api;
            $authorization = $setting->getUser_header_api;

            $account_id = null;
            $parts = explode(':', $data);
            $new = $parts[2];
            $account_ids = explode(',', $new);

            $email = explode('@', $parts[0]);
            $host = $email[1];
            $check_host = Mail_Setting::where('host', $host)->first();

            if ($check_host) {
                foreach ($account_ids as $account_id) {

                    $description = $parts[0] . ':' . $parts[1] . ':' . $account_id;

                    $getUser_api = str_replace('{{AD_ID}}', $account_id, $getUserApi);

                    $data = Http::withHeaders([
                        'User-Agent' => '',
                        'Authorization' => $authorization
                    ])->get("{$getUser_api}");

                    $response = $data->json();

                    if ($response) {
                        $adData = $response['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ad']['value'];

                        $price = $adData['price']['amount']['value'] ?? 0;
                        $title = $adData['title']['value'];
                        $reloadDate = $adData['last-user-edit-date']['value'];
                        $data = $adData['ad-status']['value'];
                        $name = $adData['contact-name']['value'];

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

                        $account = new Account();
                        $account->description = $description;
                        // $account->refreshToken = $refreshToken;
                        // $account->accessToken = $accessToken;
                        $account->account_id = $account_id;
                        // $account->proxy = $proxy;
                        $account->name = $name;
                        $account->adPic = $pictureLink;
                        $account->adLink = $link;
                        $account->adTitle = $title;
                        $account->adPrice = $price;
                        $account->adStatus = $status;
                        $account->reloadDate = $reloadDate;
                        $account->adId = $adData['id'];

                        $account->save();
                        $validAccountsCount++;
                    } else {
                        $invalidAccountsCount++;
                    }
                }
                if ($request->is('api/*')) {

                    if ($validAccountsCount > 0 && $invalidAccountsCount === 0) {
                        return response()->json(['message' => $validAccountsCount . ' Account Created Successfully']);
                    } elseif ($invalidAccountsCount > 0 && $validAccountsCount === 0) {
                        return response()->json(['error' => $invalidAccountsCount . ' accounts are invalid']);
                    } else {
                        return response()->json([
                            'error'=> $invalidAccountsCount . ' accounts are invalid',
                            'success'=> $validAccountsCount . ' accounts are created successfully.'
                        ]);
                    }
                    
                } else {
                    if ($validAccountsCount > 0 && $invalidAccountsCount === 0) {
                        return redirect()->route('accounts')->with('success', $validAccountsCount . ' accounts are created successfully.');
                    } elseif ($invalidAccountsCount > 0 && $validAccountsCount === 0) {
                        return redirect()->route('accounts')->with('error', $invalidAccountsCount . ' accounts are invalid');
                    } else {
                        return redirect()->route('accounts')
                            ->with('success', $validAccountsCount . ' accounts are created successfully.')
                            ->with('error', $invalidAccountsCount . ' accounts are invalid');
                    }
                }
            } else {
                return back()->with('error', 'Invalid Host');
            }
        } catch (\exception $e) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Invalid Account  ']);
            } else {
                return back()->with('error', 'Invalid Account');
            }
        }
    }
    public function EditAccount($id)
    {
        $account = Account::find($id);
        return view('admin.accounts.edit', compact('account'));
    }
    public function UpdateAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $account = Account::find($id);
            $data = $request->description;

            // $refreshToken = null;
            // $jsonString = substr($data, strpos($data, '['));
            // $jsonArray = json_decode($jsonString, true);
            // if ($jsonArray) {
            //     foreach ($jsonArray as $item) {
            //         if (isset($item['name']) && $item['name'] === 'refresh_token') {
            //             $refreshToken = $item['value'];
            //             break;
            //         }
            //     }
            // }

            // $account_id = null;
            // $userIdPattern = '/:(\d+):/';
            // if (preg_match($userIdPattern, $data, $userIdMatches)) {
            //     $account_id = $userIdMatches[1];
            // }

            $setting = Setting::first();
            $getUserApi = $setting->getUser_api;
            $authorization = $setting->getUser_header_api;

            // $parts = explode(':', $data);
            // $email = $parts[0];



            // $response = refreshAccessToken($refreshToken,$account->id);

            // $accessToken = $response['accessToken'];
            // $proxy = $response['proxy'];

            // $data = Http::withHeaders([
            //     'User-Agent' => '',
            //     'Authorization' => $authorization,
            //     'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            // ])->get("{$getUser_api}");

            // $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];

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

                if ($response) {
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

                    $account->description = $request->description;
                    // $account->refreshToken = $refreshToken;
                    $account->account_id = $account_id;
                    // $account->proxy = $proxy;
                    $account->adPic = $pictureLink;
                    $account->name = $name;
                    $account->adLink = $link;
                    $account->adTitle = $title;
                    $account->adPrice = $price;
                    $account->adStatus = $status;
                    $account->reloadDate = $reloadDate;
                    $account->adId = $adData['id'];
                    $account->save();
                    return redirect()->route('accounts')->with('success', 'Account Updated Successfully.');
                } else {
                    return back()->with('error', 'Invalid Account');
                }
            } else {
                return back()->with('error', 'Invalid Host');
            }
        } catch (\Exception $e) {
                                    
            return back()->with('error', 'Invalid Account');
        }
    }
    public function DeleteAccount($id)
    {
        Account::find($id)->delete();
        return back()->with('success', 'Account Deleted Successfully.');
    }
    public function DeleteSingleAccount(Request $request)
    {
        Account::find($request->id)->delete();
        if (Auth::user()->role == 'admin') {
            $accounts = Account::all();
        } else {
            $accounts = Account::where('buy_id', Auth::user()->id)->get();
        }
        return response()->json([
            'component' => view('admin.chat.accounts', compact('accounts'))->render(),
            'success' => 'Delete account successfully.',
        ]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $contents = file_get_contents($file->getRealPath());
        $accounts = explode("\n", $contents);

        $totalValidAccounts = 0;
        $totalInvalidAccounts = 0;

        foreach ($accounts as $account) {
            $counts = $this->create($account);
            $totalValidAccounts += $counts['valid'];
            $totalInvalidAccounts += $counts['invalid'];
        }

        $successMessage = null;
        if ($totalValidAccounts > 0) {
            $successMessage = $totalValidAccounts . ' accounts are imported successfully.';
        }

        $errorMessage = null;
        if ($totalInvalidAccounts > 0) {
            $errorMessage = $totalInvalidAccounts . ' accounts are invalid'; 
        }
        if ($request->is('api/*')) {
            return response()->json([
                'success' => $successMessage,
                'error' => $errorMessage,
            ]);
        }else{
            return redirect()->route('accounts')->with('success', $successMessage)->with('error', $errorMessage);
        }
    }
    private function create($account)
    {
        $validAccountsCount = 0;
        $invalidAccountsCount = 0;
        $data = $account;
        // $refreshToken = $this->extractRefreshToken($description);
        // $account_id = $this->extractAccountId($description);

        // $refreshToken = null;
        // $jsonString = substr($data, strpos($data, '['));
        // $jsonArray = json_decode($jsonString, true);
        // if ($jsonArray) {
        //     foreach ($jsonArray as $item) {
        //         if (isset($item['name']) && $item['name'] === 'refresh_token') {
        //             $refreshToken = $item['value'];
        //             break;
        //         }
        //     }
        // }

        // $account_id = null;
        // $userIdPattern = '/:(\d+):/';
        // if (preg_match($userIdPattern, $data, $userIdMatches)) {
        //     $account_id = $userIdMatches[1];
        // }
        $setting = Setting::first();
        $getUserApi = $setting->getUser_api;
        $authorization = $setting->getUser_header_api;

        // $parts = explode(':', $data);
        // $email = $parts[0];

        // $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);

        // $response = refreshAccessToken($refreshToken,0);

        // $accessToken = $response['accessToken'];
        // $proxy = $response['proxy'];

        $account_id = null;
        $parts = explode(':', $data);
        $new = $parts[2] ?? null;
    
        $account_ids = explode(',', $new);
        
        $email = explode('@', $parts[0]);
        $host = $email[1] ?? null;
        $check_host = Mail_Setting::where('host', $host)->first();

        if ($check_host) {
            foreach ($account_ids as $account_id) {

                $description = $parts[0] . ':' . $parts[1] . ':' . $account_id;

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
                    Account::create([
                        'description' => $description,
                        'account_id' => $account_id,
                        'adPic' => $pictureLink,
                        'name' => $name,
                        'adLink' => $link,
                        'adTitle' => $title,
                        'adPrice' => $price,
                        'adStatus' => $status,
                        'reloadDate' => $reloadDate,
                        'adId' => $adData['id']
                    ]);
                    $validAccountsCount++;
                } else {
                    $invalidAccountsCount++;
                }
            }
        }
        $data = [
            'valid' => $validAccountsCount,
            'invalid' => $invalidAccountsCount,
        ];
        return $data;
    }

    private function extractRefreshToken($description)
    {
        $refreshToken = null;
        $jsonString = substr($description, strpos($description, '['));
        $jsonArray = json_decode($jsonString, true);

        if ($jsonArray) {
            foreach ($jsonArray as $item) {
                if (isset($item['name']) && $item['name'] === 'refresh_token') {
                    $refreshToken = $item['value'];
                    break;
                }
            }
        }

        return $refreshToken;
    }

    private function extractAccountId($description)
    {
        $account_id = null;
        $userIdPattern = '/:(\d+):/';

        if (preg_match($userIdPattern, $description, $userIdMatches)) {
            $account_id = $userIdMatches[1];
        }

        return $account_id;
    }
    public function updateRegistration()
    {
        $currentRegistrationStatus = Setting::first();

        $newRegistrationStatus = $currentRegistrationStatus->registration == 0 ? 1 : 0;

        $currentRegistrationStatus->registration = $newRegistrationStatus;
        $currentRegistrationStatus->save();

        $statusMessage = $newRegistrationStatus == 1 ? 'Enabled' : 'Disabled';

        return back()->with('success', "Registration has been $statusMessage");
    }
}
