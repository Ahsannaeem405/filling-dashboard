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
            $setting->site_url = $request->url;
            $setting->save();
            return back()->with('success','Account Setting Saved.');
        }else{
            Setting::create([
                'site_url' => $request->url
            ]);
            return back()->with('success','Account Setting Saved.');
        }
        
    }
}
