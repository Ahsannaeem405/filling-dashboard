<?php

namespace App\Http\Controllers;

use App\Models\Mail_Setting;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Mail_Setting::all();
        return view('admin.settings.index',compact('settings'));
    }
    public function Create()
    {
        return view('admin.settings.create');
    }
    public function StoreSetting(Request $request)
    {   
        $this->validate($request, [
            'host'=> 'required',
            'smtp_host'=> 'required',
            'smtp_port'=> 'required',
            'smtp_encryption'=> 'required',
            'get_host'=> 'required',
            'get_port'=> 'required',
            'get_encryption'=> 'required',
        ]);
        $exist = Mail_Setting::where('host',$request->host)->first();
        if($exist){
            return back()->with('error','Host already exist.');
        }else{
            $setting = new Mail_Setting();
            $setting->host = $request->host;
            $setting->smtp_host = $request->smtp_host;
            $setting->smtp_port = $request->smtp_port;
            $setting->smtp_encryption = $request->smtp_encryption;
            $setting->get_host = $request->get_host;
            $setting->get_port = $request->get_port;
            $setting->get_encryption = $request->get_encryption;
            $setting->save();
            return redirect()->route('setting')->with('success','Mail Configuration Created.');
        }

        // $setting = Setting::first();
        // if($setting){
        //     $setting->accessToken_api = $request->accessToken_api;
        //     $setting->getUser_api = $request->getUser_api;
        //     $setting->accessToken_header_api = $request->accessToken_header_api;
        //     $setting->getUser_header_api = $request->getUser_header_api;
        //     $setting->getUserConv_api = $request->getUserConv_api;
        //     $setting->getUserConvMsg_api = $request->getUserConvMsg_api;
        //     // $setting->getUserConvImg_api = $request->getUserConvImg_api;
        //     $setting->image_header_api = $request->image_header_api;
        //     $setting->postMsg_api = $request->postMsg_api;
        //     $setting->delete_api = $request->delete_api;
        //     $setting->save();
        //     return back()->with('success','Api Setting Updated.');
        // }else{
        //     Setting::create([
        //         'accessToken_api' => $request->accessToken_api,
        //         'getUser_api' => $request->getUser_api,
        //         'accessToken_header_api' => $request->accessToken_header_api,
        //         'getUser_header_api' => $request->getUser_header_api,
        //         'getUserConv_api' => $request->getUserConv_api,
        //         'getUserConvMsg_api' => $request->getUserConvMsg_api,
        //         // 'getUserConvImg_api' => $request->getUserConvImg_api,
        //         'image_header_api' => $request->image_header_api,
        //         'postMsg_api' => $request->postMsg_api,
        //         'delete_api' => $request->delete_api,
        //     ]);
        //     return back()->with('success','Api Setting Created.');
        // }
        
    }
    public function EditHost($id)
    {
        $setting = Mail_Setting::find($id);
        return view('admin.settings.edit',compact('setting'));
    }
    public function UpdateHost(Request $request ,$id)
    {
        $this->validate($request, [
            'host'=> 'required',
            'smtp_host'=> 'required',
            'smtp_port'=> 'required',
            'smtp_encryption'=> 'required',
            'get_host'=> 'required',
            'get_port'=> 'required',
            'get_encryption'=> 'required',
        ]);
        $setting = Mail_Setting::find($id);
        $setting->host = $request->host;
        $setting->smtp_host = $request->smtp_host;
        $setting->smtp_port = $request->smtp_port;
        $setting->smtp_encryption = $request->smtp_encryption;
        $setting->get_host = $request->get_host;
        $setting->get_port = $request->get_port;
        $setting->get_encryption = $request->get_encryption;
        $setting->save();
        return redirect()->route('setting')->with('success','Mail Configuration Updated.');
    }
    public function DeleteHost($id)
    {
        Mail_Setting::find($id)->delete();
        return back()->with('success', 'Host Deleted Successfully.');
    }
}
