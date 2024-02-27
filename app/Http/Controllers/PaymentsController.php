<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Conversation;
use App\Models\Messages;
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
        try{
            $setting = Setting::first();
            $getUserConvMsgAPi = $setting->getUserConvMsg_api;

            $account = Account::find($request->id);
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;
            $conv_id = $request->conv_id;

//            $msg_api = str_replace('{USERID}', $user_id, $getUserConvMsgAPi);
//
//            $conv_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);
//
//            $accessToken = refreshAccessToken($refreshToken,$account->id);
//
//
//            $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
//                ->get("{$conv_msg_api}");


                Payment::updateOrCreate(
                ['conv_id' => $conv_id],
                [
                 'user_id'=>Auth::id(),
                'account_id' => $account->id,
                'payment_method'=>$request->method,
                'price' => $account->adPrice,
                'client_name'=>$account->adTitle,
                ]
                );


            return response()->json(['success' => 'Payment wurde angefordert.']);
        }
        catch(\Exception $e){
            return response()->json(['success' => 'Something went wrong.']);
        }

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
        }else if($request->status == 'reject'){
            $payment->reason = $request->rejectReason;
        }else{
            $payment->reason = $request->transection_id;
        }
        $payment->save();
        return redirect()->route('payment')->with('success', 'Status updated successfully');
    }
    public function Chat($id)
    {


        try {
            $payment = Payment::find($id);
            $conv_id = $payment->conv_id;

            $setting = Setting::first();
            $getUserConvMsgAPi = $setting->getUserConvMsg_api;

            $account = Account::find($payment->account_id);
            $user_id = $account->account_id;
            $refreshToken = $account->refreshToken;

            // $msg_api = str_replace('{USERID}', $user_id, $getUserConvMsgAPi);

            // $conv_msg_api = str_replace('{CONVERSATIONID}', $conv_id, $msg_api);

            // $accessToken = refreshAccessToken($refreshToken,$account->id);

            // $data = Http::withHeaders(['User-Agent' => ''])->withToken($accessToken['accessToken'])
            //     ->get("{$conv_msg_api}");
            // $data = $data->json();

            $name = Conversation::find($conv_id);
 
            $data = Messages::whereConversationId($conv_id)->get();

            if(!empty($data)){
                if (Auth::user()->role == 'admin') {
                    return view('admin.payment.chat', compact('data', 'account','name'));
                } else {
                    return view('admin.payment.user_side.chat', compact('data', 'account','name'));
                }
            }else{
                return back()->with('error','An error occurred. Please try again.');
            }


        } catch (\Exception $e) {
            return back()->with('error','An error occurred. Please try again.');
        }

    }
    public function DeletePayment($id)
    {
        Payment::find($id)->delete();
        return back()->with('success', 'Deleted Successfully.');
    }
    public function RemovePayment(Request $request)
    {
        $payment = Payment::where('conv_id',$request->conv_id);

        if ($payment) {
            $payment->delete();
            return response()->json(['success' => 'Payment wurde entfernt.']);
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
