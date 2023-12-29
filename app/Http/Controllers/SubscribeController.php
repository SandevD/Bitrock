<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeRequest;
use App\Mail\SubscribeRequestReply;
use App\Mail\UnsubscribeRequest;
use App\Mail\UnsubscribeRequestReply;
use App\Models\Subscriber;
use App\Models\Unsubscribe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscriber::pluck('transaction_no');

        $response_url = route('subscribe.status');
        $return_url = route('subscribe.return_url');

        $merchant_id = 'PB12461';
        $secret = '476b1256c7e578f917faba5470734ffd99d2550cf8d0314d30928caf29cb85b5';

        $orderId = $merchant_id . '-' . date("ymds");

        $stage = [
            'local' => 'LOCAL',
            'dev' => 'DEV',
            'prod' => 'PROD'
        ];

        $selected_stage = $stage['prod'];


        $payRequest = [
            "merchant_id" => $merchant_id,
            "amount" => '399',
            "type" => 'RECURRING',
            "start_date" => now()->format('Y-m-d'),
            "do_initial_payment" => 1,
            "interval"  => 1,
            "order_id" => $orderId,
            "currency" => 'LKR',
            "return_url" => $return_url,
            "response_url" => $response_url,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "phone" => $request->dp_telegram,
            "email" => $request->dp_email,
            "page_type" => 'IN_APP',
            "logo" => 'https://thisisbitrock.com/assets/img/Logo.png',
            "description" => 'Bitrock Bulletin Monthly Subscription',
        ];

        $subscribe = new Subscriber();
        $subscribe->transaction_no = $orderId;
        $subscribe->first_name = $request->first_name;
        $subscribe->last_name = $request->last_name;
        $subscribe->email = $request->dp_email;
        $subscribe->telegram = $request->dp_telegram;
        $subscribe->status = 2;
        $subscribe->save();

        $dataString = base64_encode(json_encode($payRequest));
        $signature = hash_hmac('sha256', $dataString, $secret);
        $stage = $selected_stage;
        return view('direct_pay', compact('dataString', 'signature', 'stage', 'orderId'));
    }

    public function subscribe(Request $req)
    {
        Log::info('RESPONSE RECIEVED');
        Log::info($req);
        $notify[] = ['success', 'Thank You For Subscribing To Our Newsletter!'];
        return back()->withNotify($notify);
    }

    public function status(Request $request)
    {
        Log::info('RESPONSE RECIEVED');
        Log::info($request);
        if ($request->status == 'FAILED') {
            $subscription = Subscriber::where('transaction_no', $request->orderId)->first();
            $subscription->status = 0;
            $subscription->save();
            $notify[] = ['error', 'Payment incomplete, subcription unsuccessful!'];
            return redirect()->route('welcome.index')->withNotify($notify);;
        }

        if ($request->status == 'SUCCESS') {
            $subscription = Subscriber::where('transaction_no', $request->orderId)->first();
            $subscription->status = 1;
            $subscription->save();
            $notify[] = ['success', 'Payment complete, subcription successful. Our team will get in touch with you via telegram!'];
            return redirect()->route('welcome.index')->withNotify($notify);;
        }
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dp_email' => 'required|email',
            'dp_telegram' => 'required|min:10',
            'transaction_no' => 'required',
        ]);

        $unsubscribe = new Unsubscribe();
        $unsubscribe->first_name = $request->first_name;
        $unsubscribe->last_name = $request->last_name;
        $unsubscribe->email = $request->dp_email;
        $unsubscribe->telegram = $request->dp_telegram;
        $unsubscribe->transaction_no = $request->transaction_no;
        $unsubscribe->status = 0;
        $unsubscribe->save();

        $data = [
            'subject' => 'Unsubscription Request',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->dp_email,
            'telegram' => $request->dp_telegram,
            'transaction_no' => $request->transaction_no,
        ];

        Mail::to('damiru@thisisbitrock.com')->send(new UnsubscribeRequest($data));
        Mail::to($request->dp_email)->send(new UnsubscribeRequestReply($data));

        $notify[] = ['success', 'Our support team will get in touch with you. Thank you for your cooperation!'];
        return back()->withNotify($notify);
    }

    public function showSubs()
    {
        $subscribers = Subscriber::orderby('created_at', 'desc')->paginate(25);
        return view('dashboard.subscribers', compact('subscribers'));
    }

    public function showUnSubs()
    {
        $unsubscribes = Unsubscribe::orderby('created_at', 'desc')->paginate(25);
        return view('dashboard.unsubscribes', compact('unsubscribes'));
    }

    public function complete($id)
    {
        try {
            $unsubscribe = Unsubscribe::find($id);
            if ($unsubscribe) {
                $unsubscribe->status = 1;
                $unsubscribe->save();
            } else {
                $notify[] = ['error', 'Bad Request'];
                return back()->withNotify($notify);
            }
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Request Completed'];
        return back()->withNotify($notify);
    }

    public function return_urlPayment(Request $request)
    {
        Log::info('Payment Returned');
        Log::info($request->status);

        if ($request->status == 'FAILED') {
            $subscription = Subscriber::where('transaction_no', $request->orderId)->first();
            $subscription->status = 0;
            $subscription->save();
            $notify[] = ['error', 'Payment incomplete, subcription unsuccessful!'];
            return redirect()->route('welcome.index')->withNotify($notify);
        }

        if ($request->status == 'SUCCESS') {
            $subscription = Subscriber::where('transaction_no', $request->orderId)->first();
            $subscription->status = 1;
            $subscription->save();

            $data = [
                'subject' => 'Bitrock Bulletin Subscription',
                'transaction_no' => $subscription->transaction_no,
                'first_name' => $subscription->first_name,
                'last_name' => $subscription->last_name,
                'email' => $subscription->email,
                'telegram' => $subscription->telegram,
            ];

            Mail::to('damiru@thisisbitrock.com')->send(new SubscribeRequest($data));
            Mail::to($subscription->email)->send(new SubscribeRequestReply($data));

            $notify[] = ['success', 'Payment complete, subcription successful. Our team will get in touch with you via telegram!'];
            return redirect()->route('welcome.index')->withNotify($notify);
        }
    }

    public function orderCancel(Request $request)
    {
        try {

            $subscription = Subscriber::where('transaction_no', $request->orderId)->first();
            $subscription->status = 0;
            $subscription->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
