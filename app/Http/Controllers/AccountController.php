<?php

namespace App\Http\Controllers;

use App\Imports\AccountImport;
use App\Models\Account;
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

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $data = $request->description;

            $refreshToken = null;
            $jsonString = substr($data, strpos($data, '['));
            $jsonArray = json_decode($jsonString, true);
            if ($jsonArray) {
                foreach ($jsonArray as $item) {
                    if (isset($item['name']) && $item['name'] === 'refresh_token') {
                        $refreshToken = $item['value'];
                        break;
                    }
                }
            }
            $account_id = null;
            $userIdPattern = '/:(\d+):/';
            if (preg_match($userIdPattern, $data, $userIdMatches)) {
                $account_id = $userIdMatches[1];
            }
            $setting = Setting::first();
            $getUserApi = $setting->getUser_api;
            $authorization = $setting->getUser_header_api;

            $parts = explode(':', $data);
            $email = $parts[0];

            $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);
            $response = refreshAccessToken($refreshToken,0);

            $accessToken = $response['accessToken'];
            $proxy = $response['proxy'];

            $data = Http::withHeaders([
                'User-Agent' => '',
                'Authorization' => $authorization,
                'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            ])->get("{$getUser_api}");

            $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];

            $price = $adData['price']['amount']['value'];
            $title = $adData['title']['value'];
            $reloadDate = $adData['last-user-edit-date']['value'];
            $status = $adData['ad-status']['value'];

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
            $account->description = $request->description;
            $account->refreshToken = $refreshToken;
            $account->accessToken = $accessToken;
            $account->account_id = $account_id;
            $account->proxy = $proxy;
            $account->adPic = $pictureLink;
            $account->adLink = $link;
            $account->adTitle = $title;
            $account->adPrice = $price;
            $account->adStatus = $status;
            $account->reloadDate = $reloadDate;

            $account->save();

            if ($request->is('api/*')) {
                return response()->json(['message' => 'Account Created Successfully']);
            } else {
                return redirect()->route('accounts')->with('success', 'Account Created Successfully');
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

            $refreshToken = null;
            $jsonString = substr($data, strpos($data, '['));
            $jsonArray = json_decode($jsonString, true);
            if ($jsonArray) {
                foreach ($jsonArray as $item) {
                    if (isset($item['name']) && $item['name'] === 'refresh_token') {
                        $refreshToken = $item['value'];
                        break;
                    }
                }
            }

            $account_id = null;
            $userIdPattern = '/:(\d+):/';
            if (preg_match($userIdPattern, $data, $userIdMatches)) {
                $account_id = $userIdMatches[1];
            }
            $setting = Setting::first();
            $getUserApi = $setting->getUser_api;
            $authorization = $setting->getUser_header_api;

            $parts = explode(':', $data);
            $email = $parts[0];

            $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);

            $response = refreshAccessToken($refreshToken,$account->id);

            $accessToken = $response['accessToken'];
            $proxy = $response['proxy'];

            $data = Http::withHeaders([
                'User-Agent' => '',
                'Authorization' => $authorization,
                'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            ])->get("{$getUser_api}");
// dd($data->json());
            $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];

            $price = $adData['price']['amount']['value'];
            $title = $adData['title']['value'];
            $reloadDate = $adData['last-user-edit-date']['value'];
            $status = $adData['ad-status']['value'];

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
            $account->refreshToken = $refreshToken;
            $account->account_id = $account_id;
            $account->proxy = $proxy;
            $account->adPic = $pictureLink;
            $account->adLink = $link;
            $account->adTitle = $title;
            $account->adPrice = $price;
            $account->adStatus = $status;
            $account->reloadDate = $reloadDate;

            $account->save();

            return redirect()->route('accounts')->with('success', 'Account Updated Successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid Account');
        }
    }
    public function DeleteAccount($id)
    {
        Account::find($id)->delete();
        return back()->with('success', 'Account Deleted Successfully.');
    }
    public function DeleteSingleAccount(Request $request){
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

        foreach ($accounts as $account) {
            $this->create($account);
        }

        return redirect()->route('accounts')->with('success', 'Accounts Imported Successfully.');
    }
    private function create($account)
    {
        $description = $account;
        $refreshToken = $this->extractRefreshToken($description);
        $account_id = $this->extractAccountId($description);

        $data = $description;

        $refreshToken = null;
        $jsonString = substr($data, strpos($data, '['));
        $jsonArray = json_decode($jsonString, true);
        if ($jsonArray) {
            foreach ($jsonArray as $item) {
                if (isset($item['name']) && $item['name'] === 'refresh_token') {
                    $refreshToken = $item['value'];
                    break;
                }
            }
        }

        $account_id = null;
        $userIdPattern = '/:(\d+):/';
        if (preg_match($userIdPattern, $data, $userIdMatches)) {
            $account_id = $userIdMatches[1];
        }
        $setting = Setting::first();
        $getUserApi = $setting->getUser_api;
        $authorization = $setting->getUser_header_api;

        $parts = explode(':', $data);
        $email = $parts[0];

        $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);

        $response = refreshAccessToken($refreshToken,0);

        $accessToken = $response['accessToken'];
        $proxy = $response['proxy'];


        $data = Http::withHeaders([
            'User-Agent' => '',
            'Authorization' => $authorization,
            'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
        ])->get("{$getUser_api}");
        if($data->json() !== null){
            $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];

            $price = $adData['price']['amount']['value'];
            $title = $adData['title']['value'];
            $reloadDate = $adData['last-user-edit-date']['value'];
            $status = $adData['ad-status']['value'];

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
                'refreshToken' => $refreshToken,
                'account_id' => $account_id,
                'accessToken' => $accessToken,
                'proxy' => $proxy,
                'adPic' => $pictureLink,
                'adLink' => $link,
                'adTitle' => $title,
                'adPrice' => $price,
                'adStatus' => $status,
                'reloadDate' => $reloadDate
            ]);
        }else{
            Account::create([
                'description' => $description,
                'refreshToken' => $refreshToken,
                'account_id' => $account_id,
            ]);
        }

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
