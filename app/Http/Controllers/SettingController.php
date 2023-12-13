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
            $setting->accessToken_header_api = $request->accessToken_header_api;
            $setting->getUser_header_api = $request->getUser_header_api;
            $setting->getUserConv_api = $request->getUserConv_api;
            $setting->getUserConvMsg_api = $request->getUserConvMsg_api;
            // $setting->getUserConvImg_api = $request->getUserConvImg_api;
            $setting->image_header_api = $request->image_header_api;
            $setting->postMsg_api = $request->postMsg_api;
            $setting->delete_api = $request->delete_api;
            $setting->save();
            return back()->with('success','Api Setting Updated.');
        }else{
            Setting::create([
                'accessToken_api' => $request->accessToken_api,
                'getUser_api' => $request->getUser_api,
                'accessToken_header_api' => $request->accessToken_header_api,
                'getUser_header_api' => $request->getUser_header_api,
                'getUserConv_api' => $request->getUserConv_api,
                'getUserConvMsg_api' => $request->getUserConvMsg_api,
                // 'getUserConvImg_api' => $request->getUserConvImg_api,
                'image_header_api' => $request->image_header_api,
                'postMsg_api' => $request->postMsg_api,
                'delete_api' => $request->delete_api,
            ]);
            return back()->with('success','Api Setting Created.');
        }
        
    }
}
