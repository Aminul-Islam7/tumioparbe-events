<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;
use tidy;
use GuzzleHttp\Client;

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
            'district' => ['max:50'],
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
        $ticketPrice = config('settings.ticketPrice');
        $amount = $tickets*$ticketPrice;
        
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


        $name = Session::get('name');
        $phone = Session::get('phone');
        $district = Session::get('district');
        $tickets = Session::get('tickets');
        $payID = $request->paymentID;


        $registration = new Registration;
        
        

        $registration->name = $name;
        $registration->phone = $phone;
        $registration->district = $district;
        $registration->tickets = $tickets;
        $registration->pay_id = $payID;
        $registration->status = $request->status;

        Session::forget('name');
        Session::forget('phone');
        Session::forget('district');
        Session::forget('tickets');


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

                $lastRecordWithRegNo = Registration::whereNotNull('reg_no')->latest()->first();

                if ($lastRecordWithRegNo) {
                    $lastRegNo = $lastRecordWithRegNo->reg_no;
                } else {
                    $lastRegNo = 24000;
                }

                $registration->reg_no = $lastRegNo + 1;

                $registration->amount = $response["amount"];
                $registration->bkash_number = $response["customerMsisdn"];
                $registration->trx_id = $response["trxID"];
                $registration->payer_ref = $response["payerReference"];
                $registration->invoice_no = $response["merchantInvoiceNumber"];
                $registration->status = $response["statusMessage"];
                $registration->status_code = $response["statusCode"];
                $registration->intent = $response["intent"];
                $registration->trx_status = $response["transactionStatus"];
                $registration->pay_execute_time = $response["paymentExecuteTime"];

                $registration->save();


                $url = 'http://api.greenweb.com.bd/api.php';
                $message =  sprintf("Your registration is confirmed for %d seats!\r\n\r\nRegistration Number: %d\r\nPlease retain this for reference.\r\n\r\nThank you,\r\nতুমিও পারবে।", $tickets, $registration->reg_no);
                $data = array(
                                'to' => $phone,
                                'message' => $message,
                                'token' => '96480520021706829602bb4e08e044c5f8d1efeab8608f09ce33'
                            );

                $client = new Client();
                $smsResponse = $client->post($url, ['form_params' => $data]);

                // return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
                return redirect()->route('success', ['payID' => $response['paymentID']]);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            
            $registration->save();
            
            return redirect()->route('cancelled', ['payID' => $payID]);

            // return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{

            $registration->save();

            return redirect()->route('failed', ['payID' => $payID]);

            // return BkashPaymentTokenize::failure('Your transaction is failed');
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
