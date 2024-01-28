<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        
        // dd($request->all());


        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'district' => ['string', 'max:50'],
            'tickets' => ['required', 'integer', 'min:1'],
        ],
        [
            'name' => 'নামটি সঠিক ভাবে লিখুন।',
            'phone' => 'ফোন নম্বরটি সঠিক নয়।',
            'tickets' => 'কমপক্ষে ১ টি টিকেট নিতে হবে।',
        ]);
        
        $name = $request->name;
        $phone = $request->phone;
        $district = $request->district;
        $tickets = $request->tickets;
        $amount = 1000*$tickets;
        
        Session::put('name', $name);
        Session::put('phone', $phone);
        Session::put('district', $district);
        Session::put('tickets', $tickets);

        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $amount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */

                $name = Session::get('name');
                $phone = Session::get('phone');
                $district = Session::get('district');
                $tickets = Session::get('tickets');

                Session::forget('name');
                Session::forget('phone');
                Session::forget('district');
                Session::forget('tickets');

                // dd(array_keys($response));

                $registration = new Registration;

                $lastRecord = Registration::latest()->first();

                if ($lastRecord) {
                    $lastId = $lastRecord->id;
                    
                } else {
                    $lastId = 0;
                }

                $registration->reg_no = 24000 + $lastId + 1;

                $registration->name = $name;
                $registration->phone = $phone;
                $registration->district = $district;
                $registration->tickets = $tickets;

                $registration->amount = $response["amount"];
                $registration->bkash_number = $response["customerMsisdn"];
                $registration->trx_id = $response["trxID"];
                $registration->payer_ref = $response["payerReference"];
                $registration->invoice_no = $response["merchantInvoiceNumber"];
                $registration->pay_id = $response["paymentID"];
                $registration->status = $response["statusMessage"];
                $registration->status_code = $response["statusCode"];
                $registration->intent = $response["intent"];
                $registration->trx_status = $response["transactionStatus"];
                $registration->pay_execute_time = $response["paymentExecuteTime"];

                $registration->save();

                // return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
                return redirect()->route('success', ['paymentID' => $response['paymentID']]);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
