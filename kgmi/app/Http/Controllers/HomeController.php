<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\PaymentInformation;
use Razorpay\Api\Api;
use File;
use Response;

class HomeController extends BaseController
{
    
    public function index(Request $request){

    	$bookingid  = $request->bookingid;

        return view('welcome',compact('bookingid'));
    }
    public function paymentStatus(Request $request,$status)
    { 
        return view('welcome',compact('status'));
    }

    public function paymentResult(Request $request)
    {
        //Input items of form
        $input = $request->all();
        //get API Configuration 
        $api = new Api(config('global.razor_key'), config('global.razor_secret')); 

        //Fetch payment information by razorpay_payment_id
      //  $input['razorpay_payment_id'] = 'pay_MFG6mrjNLOv9EH';
      //  echo $input['razorpay_payment_id'];



        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id']); 

                \Session::put('payment_message', 'Payment pending, please contact our customer support if you have any issue in payment .');
                if($response->status=='captured' && $response->captured==1)
                {
                	$data = array();
                	foreach($response as $key=> $dataInfo)
                	{
                		$data[$key] = $dataInfo;
                	} 
                	$responseData = (array)$response;
                	$amount = $response->amount/100;
                    PaymentInformation::where('transaction_id',$response->order_id)->update(['status' => 'Completed','amount'=>$amount,'payment_information'=> json_encode($data)]);
                    \Session::put('payment_message', 'Payment successful, your booking will be confirmed within next 24 hours.'); 

                     return redirect()->route('paymentStatus',['status'=>'success']);
                }else{
                     return redirect()->route('paymentStatus',['status'=>'failed']);
                } 


               // $response->order_id

            } catch (\Exception $e) {
               // return  $e->getMessage();
              //  \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

            // Do something here for store payment details in database...
        }

         
    }

}
