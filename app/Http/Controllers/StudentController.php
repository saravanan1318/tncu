<?php

namespace App\Http\Controllers;

use App\Models\StudentParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use io\billdesk\client\hmacsha256\BillDeskJWEHS256Client;
use io\billdesk\client\Logging;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class StudentController extends Controller
{
    function dashboard(){

        if(Auth::user()->otp_verified == 0){
            return redirect('login')->with('error', 'OTP not verified');
        }

        return view("student.studentdashboard");

    }
    function payment(Request $request)
    {

        if(Auth::user()->otp_verified == 0){
            return redirect('login')->with('error', 'OTP not verified');
        }

        $terms=$request->input("terms");
        $amount=0;
        foreach ($terms as $term)
        {
            if($term==1)
            {
                $amount+=6750;
            }
            if($term==2)
            {
                $amount+=6000;
            }
            if($term==3)
            {
                $amount+=6000;
            }

        }
        Log::info(Auth::user()->id);
        $student=StudentParams::where("status",'1')->where("user_id",Auth::user()->id)->get();
        Log::info(count($student));
        Log::info($student[0]->arrn_number);
        Log::info(implode(",",$terms));
        if(count($student)==1) {
            $MerchantID = "BDUATV2TND";
            $ClientID = "bduatv2tnd";
            $responseurl = "https://www.merchantwebsite.com/ru.php";
            $secretkey = 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4';
            $returnURL = "https://www.merchantwebsite.com/paymentresponse.php";
            $billdesk_URL = "https://pguat.billdesk.io/payments/ve1_2/orders/create";
            $transaction_id=$student[0]->arrn_number."-".implode(",",$terms);
            $totalamount=$amount;
            $date_atom =date("dd-mm-yyyy h:i:s");
            $CustomerID=Auth::user()->id;
            $PaymentFor=$amount;
            $ipaddress= $_SERVER['REMOTE_ADDR'];

            $clientID = $ClientID;
            $secretKey = $secretkey;
            $merchantID = $MerchantID;

    // Create the client and set up logging
            $client = new BillDeskJWEHS256Client("https://pguat.billdesk.io", $clientID, $secretKey);
            $logger = new Logger("default");
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
            $client->setLogger($logger);

    // Prepare the request data
            $request = array(
                'mercid' => $merchantID,
                'orderid' => uniqid(),
                'amount' => $totalamount,
                'order_date' => date_format(new \DateTime(), DATE_W3C),
                'currency' => "356",
                'ru' => "https://www.billdesk.io",
                'itemcode' => "DIRECT",
                'device' => array(
                    'init_channel' => 'internet',
                    'ip' => "$ipaddress",
                    'user_agent' => 'Mozilla/5.0'
                )
            );

    // Call the createOrder API
            $response = $client->createOrder($request);

    // Handle the response as needed
            if ($response->getResponseStatus() === 200) {
                // Success
                $responseData = $response->getResponse();
                $bdorderid=$responseData->bdorderid;
                $authToken=$responseData->links[1]->headers->authorization;
                $returnUrl=$responseData->ru;
                $tmp=[];
                $tmp["status"]="SUCCESS";
                $tmp["merchantID"]=$merchantID;
                $tmp["bdorderid"]=$bdorderid;
                $tmp["authToken"]=$authToken;
                $tmp["returnUrl"]=$returnUrl;
                $returndata=json_encode($tmp);
            } else {
                // Handle the error
                $responseData = $response->getResponse();
                $tmp=[];
                $tmp["status"]="ERROR";
                $tmp["message"]=$responseData->message;
                $tmp["error_code"]=$responseData->error_code;
                $tmp["error_type"]=$responseData->error_type;
                $returndata=json_encode($tmp);
                // Process $errorResponse here
            }
        }
        else{
            $tmp=[];
            $tmp["status"]="ERROR";
            $tmp["message"]="you are facing dome issue please contact admin!";
            $returndata=json_encode($tmp);
        }

        return $returndata;
    }
    //
}
