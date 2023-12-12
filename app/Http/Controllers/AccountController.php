<?php

namespace App\Http\Controllers;

use App\Imports\AccountImport;
use App\Models\Account;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        try{
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
            $accessTokenApi = $setting->accessToken_api;
            $getUserApi = $setting->getUser_api;
    
            $parts = explode(':', $data);
            $email = $parts[0];
    
            $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);
            $response = refreshAccessToken($refreshToken, $accessTokenApi);
    
            $accessToken = $response['accessToken'];
    
            $data = Http::withHeaders([
                'User-Agent' => '',
                'Authorization' => 'Basic aXBob25lOmc0Wmk5cTEw',
                'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            ])->get("{$getUser_api}");
            
            $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];
    
            $price = $adData['price']['amount']['value'];
            $title = $adData['title']['value'];
            $reloadDate = $adData['last-user-edit-date']['value'];
            $status = $adData['ad-status']['value'];
    
    
            $pictureLink = null;
            if (isset($adData['pictures']['picture'][0]['link'][0]['href'])) {
                $pictureLink = $adData['pictures']['picture'][0]['link'][0]['href'];
            }
    
            $account = new Account();
            $account->description = $request->description;
            $account->refreshToken = $refreshToken;
            $account->accessToken = $accessToken;
            $account->account_id = $account_id;
            $account->adPic = $pictureLink;
            $account->adTitle = $title;
            $account->adPrice = $price;
            $account->adStatus = $status;
            $account->reloadDate = $reloadDate;
    
            $account->save();
            return redirect()->route('accounts')->with('success', 'Account Created Successfully');
        } catch(\exception $e){
            return back()->with('error','Invalid Account');
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
            $accessTokenApi = $setting->accessToken_api;
            $getUserApi = $setting->getUser_api;

            $parts = explode(':', $data);
            $email = $parts[0];

            $getUser_api = str_replace('{USERID}', $account_id, $getUserApi);

            $response = refreshAccessToken($refreshToken, $accessTokenApi);

            $accessToken = $response['accessToken'];
           

            $data = Http::withHeaders([
                'User-Agent' => '',
                'Authorization' => 'Basic aXBob25lOmc0Wmk5cTEw',
                'X-ECG-Authorization-User' => 'email="' . $email . '", access="' . $accessToken . '"'
            ])->get("{$getUser_api}");
            // dd($data->json());
            $adData = $data['{http://www.ebayclassifiedsgroup.com/schema/ad/v1}ads']['value']['ad'][0];

            $price = $adData['price']['amount']['value'];
            $title = $adData['title']['value'];
            $reloadDate = $adData['last-user-edit-date']['value'];
            $status = $adData['ad-status']['value'];


            $pictureLink = null;
            if (isset($adData['pictures']['picture'][0]['link'][0]['href'])) {
                $pictureLink = $adData['pictures']['picture'][0]['link'][0]['href'];
            }

            $account->description = $request->description;
            $account->refreshToken = $refreshToken;
            $account->account_id = $account_id;
            $account->adPic = $pictureLink;
            $account->adTitle = $title;
            $account->adPrice = $price;
            $account->adStatus = $status;
            $account->reloadDate = $reloadDate;

            $account->save();

            return redirect()->route('accounts')->with('success', 'Account Updated Successfully.');
        } catch (\Exception $e) {
            return back()->with('error','Invalid Account');
        }
    }
    public function DeleteAccount($id)
    {
        Account::find($id)->delete();
        return back()->with('success', 'Account Deleted Successfully.');
    }
    public function Import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new AccountImport, $file);

        return redirect()->route('accounts')->with('success', 'Accounts Imported Successfully.');
    }
}
