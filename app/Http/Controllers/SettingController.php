<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Setting()
    {
        $setting = Setting::first();
        return view('admin.settings.create',compact('setting'));
    }
    public function StoreSetting(Request $request)
    {
        $setting = Setting::first();
        if($setting){
            $setting->accessToken_api = $request->accessToken_api;
            $setting->getUser_api = $request->getUser_api;
            $setting->getUserConv_api = $request->getUserConv_api;
            $setting->getUserConvMsg_api = $request->getUserConvMsg_api;
            $setting->postMsg_api = $request->postMsg_api;
            $setting->deleteMsg_api = $request->deleteMsg_api;
            $setting->save();
            return back()->with('success','Api Setting Updated.');
        }else{
            Setting::create([
                'accessToken_api' => $request->accessToken_api,
                'getUser_api' => $request->getUser_api,
                'getUserConv_api' => $request->getUserConv_api,
                'getUserConvMsg_api' => $request->getUserConvMsg_api,
                'postMsg_api' => $request->postMsg_api,
                'deleteMsg_api' => $request->deleteMsg_api,
            ]);
            return back()->with('success','Api Setting Created.');
        }
        
    }
}
