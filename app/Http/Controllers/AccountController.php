<?php

namespace App\Http\Controllers;

use App\Imports\AccountImport;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AccountController extends Controller
{
    public function Account()
    {
        $accounts = Account::all();

        return view('admin.accounts.index',compact('accounts'));
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
        $data = $request->description;

        $refreshToken = null;
        $jsonString = substr($data, strpos($data, '['));
        $jsonArray = json_decode($jsonString, true);
        if($jsonArray){
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

        $account = new Account();
        $account->description = $request->description;
        $account->refreshToken = $refreshToken;
        $account->account_id = $account_id;

        $account->save();
        return redirect()->route('accounts')->with('success','Account Created Successfully');
    }
    public function EditAccount($id)
    {
        $account = Account::find($id);
        return view('admin.accounts.edit',compact('account'));
    }
    public function UpdateAccount(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $account = Account::find($id);
    
        $data = $request->description;

        $refreshToken = null;
        $jsonString = substr($data, strpos($data, '['));
        $jsonArray = json_decode($jsonString, true);
        if($jsonArray){
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


        $account->description = $request->description;
        $account->refreshToken = $refreshToken;
        $account->account_id = $account_id;

        $account->save();
        return redirect()->route('accounts')->with('success','Account Updated Successfully.');
    }
    public function DeleteAccount($id)
    {
        Account::find($id)->delete();
        return back()->with('success','Account Deleted Successfully.');
    }
    public function Import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new AccountImport, $file);

        return redirect()->route('accounts')->with('success', 'Accounts Imported Successfully.');
    }
}
