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
        if (Auth::user()->role == 'admin') {
            $payment = Payment::all();
            return view('admin.payment.index', compact('payment'));
        } else {
            $payment = Payment::where('user_id', Auth::user()->id)->get();
            return view('admin.payment.user_side.index', compact('payment'));
        }
    }
    private function refreshAccessToken($refreshToken, $accessTokenApi)
    {
        $response = Http::withHeaders(['User-Agent' => ''])->post("{$accessTokenApi}", [
            'refreshToken' => $refreshToken,
        ]);
        return [
            'accessToken' => $response['accessToken'],
        ];
    }
    public function UploadPayment(Request $request)
    {
        $setting = Setting::first();
        $accessTokenApi = $setting->accessToken_api;
        $getUserConvMsgAPi = $setting->getUserConvMsg_api;

        $msg_api = str_replace('{USERID}', $request->user_id, $getUserConvMsgAPi);

        $conv_msg_api = str_replace('{CONVERSATIONID}', $request->conv_id, $msg_api);

        $accessToken = $this->refreshAccessToken($request->refreshToken, $accessTokenApi);


        $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->get("{$conv_msg_api}");

        $payment = Payment::where('client_id', $data['userIdBuyer'])->first();
        if ($payment) {
            $payment->user_id = Auth::user()->id;
            $payment->client_id = $data['userIdBuyer'];
            $payment->client_name = $data['buyerName'];
            $payment->seller_name = $data['sellerName'];
            $payment->chat = json_encode($data['messages']);
            $payment->price = $data['adPriceInEuroCent'] / 100;
            $payment->save();
        } else {
            $new = new Payment();
            $new->user_id = Auth::user()->id;
            $new->client_id = $data['userIdBuyer'];
            $new->client_name = $data['buyerName'];
            $new->seller_name = $data['sellerName'];
            $new->chat = json_encode($data['messages']);
            $new->price = $data['adPriceInEuroCent'] / 100;
            $new->save();
        }

        return response()->json(['success' => 'Chat data saved successfully']);
    }
    public function EditPayment($id)
    {
        $payment = Payment::find($id);
        return view('admin.payment.edit', compact('payment'));
    }
    public function UpdatePayment(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->status = $request->status;
        $payment->save();
        return redirect()->route('payment')->with('success', 'Status updated successfully');
    }
    public function Chat($id)
    {
        $payment = Payment::find($id);
        $chatMessages = json_decode($payment->chat, true);
        if (Auth::user()->role == 'admin') {
            return view('admin.payment.chat', compact('chatMessages', 'payment'));
        } else {
            return view('admin.payment.user_side.chat', compact('chatMessages', 'payment'));
        }
    }
    public function DeletePayment($id)
    {
        Payment::find($id)->delete();
        return back()->with('success', 'Deleted Successfully.');
    }
    public function PaymentView(Request $request)
    {
        $payment = Payment::find($request->id);
        if (Auth::user()->role == 'admin')
            return response()->json([
                'component' => view('admin.payment.paymentview', compact('payment'))->render(),
            ]);
        else {
            return response()->json([
                'component' => view('admin.payment.user_side.paymentview', compact('payment'))->render(),
            ]);
        }
    }
}
