<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $payment = Payment::all();
        }else{
            $payment = Payment::where('user_id',Auth::user()->id)->get();
        }
        

        return view('admin.payment.index',compact('payment'));
    }
    private function refreshAccessToken($refreshToken, $domain)
    {
        $response = Http::withHeaders(['User-Agent' => ''])->post("{$domain}/auth/refresh", [
            'refreshToken' => $refreshToken,
        ]);
        return [
            'accessToken' => $response['accessToken'],
        ];
    }
    public function UploadPayment(Request $request)
    {
        $url = Setting::first();
        $domain = $url->site_url;

        $accessToken = $this->refreshAccessToken($request->refreshToken, $domain);

        $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->get("{$domain}/messagebox/api/users/{$request->user_id}/conversations/{$request->conv_id}");

        $payment = Payment::where('client_id', $data['userIdBuyer'])->first();
        if ($payment) {
            $payment->user_id = Auth::user()->id;
            $payment->client_id = $data['userIdBuyer'];
            $payment->client_name = $data['buyerName'];
            $payment->seller_name = $data['sellerName'];
            $payment->chat = json_encode($data['messages']);
            $payment->price = $data['adPriceInEuroCent']/100;
            $payment->save();
        } else {
            $new = new Payment();
            $new->user_id = Auth::user()->id;
            $new->client_id = $data['userIdBuyer'];
            $new->client_name = $data['buyerName'];
            $new->seller_name = $data['sellerName'];
            $new->chat = json_encode($data['messages']);
            $new->price = $data['adPriceInEuroCent']/100;
            $new->save();
        }
        
        return response()->json(['success' => 'Chat data saved successfully']);
    }
    public function EditPayment($id){
        $payment = Payment::find($id);
        return view('admin.payment.edit',compact('payment'));
    }
    public function UpdatePayment(Request $request,$id)
    {
        $payment = Payment::find($id);
        $payment->status = $request->status;
        $payment->save();
        return redirect()->route('payment')->with('success','Status updated successfully');
    }
    public function Chat($id){
        $payment = Payment::find($id);
        $chatMessages = json_decode($payment->chat, true);

        return view('admin.payment.chat',compact('chatMessages','payment'));
    }
    public function DeletePayment($id)
    {
        Payment::find($id)->delete();
        return back()->with('success','Deleted Successfully.');
    }
}
