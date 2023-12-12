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
            $paidAmount = Payment::where('status', 'paid')->sum('price');
            $unpaidAmount = Payment::where('status', 'pending')->sum('price');
            $count = $payment->count();
            return view('admin.payment.index', compact('payment','count','paidAmount','unpaidAmount'));
        } else {
            $payment = Payment::where('user_id', Auth::user()->id)->get();
            $paidAmount = Payment::where('user_id', Auth::user()->id)->where('status', 'paid')->sum('price');
            $unpaidAmount = Payment::where('user_id', Auth::user()->id)->where('status', 'pending')->sum('price');
            $count = $payment->count();
            return view('admin.payment.user_side.index', compact('payment','count','paidAmount','unpaidAmount'));
        }
    }
    public function UploadPayment(Request $request)
    {
        $setting = Setting::first();
        $accessTokenApi = $setting->accessToken_api;
        $getUserConvMsgAPi = $setting->getUserConvMsg_api;

        $msg_api = str_replace('{USERID}', $request->user_id, $getUserConvMsgAPi);

        $conv_msg_api = str_replace('{CONVERSATIONID}', $request->conv_id, $msg_api);

        $accessToken = refreshAccessToken($request->refreshToken, $accessTokenApi);


        $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            ->get("{$conv_msg_api}");

        $payment = Payment::where('user_id',Auth::user()->id)->where('client_id', $data['userIdBuyer'])->first();
        if ($payment) {
            $payment->user_id = Auth::user()->id;
            $payment->ad_title = $data['adTitle'];
            $payment->client_id = $data['userIdBuyer'];
            $payment->client_name = $data['buyerName'];
            $payment->seller_name = $data['sellerName'];
            $payment->chat = json_encode($data['messages']);
            $payment->price = $data['adPriceInEuroCent'] / 100;
            $payment->save();
        } else {
            $new = new Payment();
            $new->user_id = Auth::user()->id;
            $new->ad_title = $data['adTitle'];
            $new->client_id = $data['userIdBuyer'];
            $new->client_name = $data['buyerName'];
            $new->seller_name = $data['sellerName'];
            $new->chat = json_encode($data['messages']);
            $new->price = $data['adPriceInEuroCent'] / 100;
            $new->save();
        }

        return response()->json(['success' => 'Payment wurde angefordert.']);
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
        if($request->status == 'pending'){
            $payment->reason = $request->pendingReason;
        }else{
            $payment->reason = $request->rejectReason;
        }
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
    public function RemovePayment(Request $request)
    {
        $payment = Payment::where('user_id', Auth::user()->id)->where('client_id', $request->id)->first();
    
        if ($payment) {
            $payment->delete();
            return response()->json(['success' => 'Payment Removed Successfully']);
        } else {
            return response()->json(['error' => 'Payment not found'], 404);
        }
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
