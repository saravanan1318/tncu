<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Mtr_Icm;
use App\Models\Payment_log;
use App\Models\StudentParams;
use App\Models\User;
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

    function paymentresponse(Request $request)
    {

        $token= $request->transaction_response;
        $tokenParts = explode('.', $token);

        if (count($tokenParts) !== 3) {
            // Invalid JWT format
            return null;
        }
        list($header, $payload, $signature) = $tokenParts;
        // Base64 decode the parts
        $decodedHeader = base64_decode($header);
        $decodedPayload = base64_decode($payload);

        // JSON decode the decoded parts
        $headerData = json_decode($decodedHeader, true);
        $payloadData = json_decode($decodedPayload, true);
//        return json_encode($payloadData);
        $paymentlogs=Payment_log::find($payloadData["additional_info"]["additional_info5"]);
//        $paymentlogs ->userid= $payloadData["additional_info"]["additional_info1"];
        $paymentlogs ->response = $token;
        $paymentlogs->save();
        if($payloadData["transaction_error_type"]=="success" && $payloadData["auth_status"]== "0300" ){
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentID= $payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];



            $icmdetails = User::where('id',$ICM_ID)->first();
            $actualinv =$icmdetails->invoiceNo +1;

            $Student = User::where('id', $studentID)
                ->first();
            if ($Student) {
                Auth::login($Student);
                $invoiceNo = 'INV'.$ICM_ID.'-'.$actualinv;
                foreach ($termdetails as $termdetail)
                {
                    $invoice = new Invoice;
                    $invoice->invoiceNo = $invoiceNo;
                    $invoice->payment_mode = "ONLINE";
                    $invoice->student_id = $studentID;
                    $invoice->term = "TUITION FESS - TERM ".$termdetail;
                    if($termdetail ==1)
                    {
                        $termamount=6750.00;
                    }
                    if($termdetail ==2)
                    {
                        $termamount=6000.00;
                    }
                    if($termdetail ==3)
                    {
                        $termamount=6000.00;
                    }
                    $invoice->amount = $termamount;
                    $invoice->save();
                }
                $user = User::where('id',$ICM_ID)->first();
                $user->invoiceNo = $actualinv;
//                $user->update();

                $student = StudentParams::where('user_id',Auth::user()->id)->first();

                if(is_null($student->admission_number) || empty($student->admission_number)){

                    $gender = "F";

                    if($student->gender == "Male"){
                        $gender = "M";
                    }

                    $icmname = Mtr_icm::where('id',$ICM_ID)->first();
                    $short_name =  $icmname['short_name'];
                    $admission_count =  $icmname['admission_count'];
                    $admission_number = $short_name.date("Y").$gender.'AN'.sprintf("%03d", $admission_count);
                    $student->admission_number = $admission_number;
//                    return  $admission_number;
//                    $student->update();

                    $icmname->admission_count = $admission_count+1;
//                    $icmname->update();
                }

                    $returnMessage="SUCCESS";
                $transaction_date=$payloadData["transaction_date"];
                $transactionid=$payloadData["transactionid"];
                $amount=$payloadData["amount"];
                return   view("student.studentdashboard" ,compact("returnMessage" , "transactionid","transaction_date","amount"));
            } else {
                return back()->withErrors(['email' => 'Invalid credentials']); // Authentication failed
            }

        }
        elseif ($payloadData["auth_status"]== "0002")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentID= $payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $icmdetails = User::where('id',$ICM_ID)->first();
            $actualinv =$icmdetails->invoiceNo +1;

            $Student = User::where('id', $studentID)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];
            return   view("student.studentdashboard" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        elseif ($payloadData["auth_status"]== "0399")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentID= $payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $icmdetails = User::where('id',$ICM_ID)->first();
            $actualinv =$icmdetails->invoiceNo +1;

            $Student = User::where('id', $studentID)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];
            return   view("student.studentdashboard" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        else{
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentID= $payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $icmdetails = User::where('id',$ICM_ID)->first();
            $actualinv =$icmdetails->invoiceNo +1;

            $Student = User::where('id', $studentID)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            return   view("student.studentdashboard" ,compact("returnMessage"));
        }


//        return $decodedPayload;

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
                $amount+=6750.00;
            }
            if($term==2)
            {
                $amount+=6000.00;
            }
            if($term==3)
            {
                $amount+=6000.00;
            }

        }
        if($amount > 18750 || $amount < 6000){
            $tmp=[];
            $tmp["status"]="ERROR";
            $tmp["message"]="Please choose Proper Payments !";
            $tmp["error_code"]="";
            $tmp["error_type"]="";
            $returndata=json_encode($tmp);
            return $returndata;
        }
        $invoicedetails = Invoice::where('student_id', Auth::user()->id)->sum('amount');

        if($invoicedetails > 18750 || $invoicedetails == 18750){
            $tmp=[];
            $tmp["status"]="ERROR";
            $tmp["message"]="Already paid the full amount!";
            $tmp["error_code"]="";
            $tmp["error_type"]="";
            $returndata=json_encode($tmp);
            return $returndata;
        }
        $student=StudentParams::where("status",'1')->where("user_id",Auth::user()->id)->get();
        $amount=1;
        if(count($student)==1) {
            $MerchantID = "TMLNDUCOUN";
            $ClientID = "tmlnducoun";
            $responseurl = "https://tncuicm.com/student/paymentresponse";
          //  $secretkey = 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4';  //Developement
            $secretkey = 'nBxE5Uw4i0hGZQia2dETrVAV1KrxALaB';  //Production
            $returnURL = "https://tncuicm.com/student/paymentreturn";
            $billdesk_URL = "https://api.billdesk.com/payments/ve1_2/orders/create";
            $transaction_id=$student[0]->arrn_number."-".implode(",",$terms);
            $totalamount=$amount;
            $date_atom =date("dd-mm-yyyy h:i:s");
            $StudentID=Auth::user()->id;
            $PaymentFor=$amount;
            $ipaddress= $_SERVER['REMOTE_ADDR'];

            $clientID = $ClientID;
            $secretKey = $secretkey;
            $merchantID = $MerchantID;

    // Create the client and set up logging
            $client = new BillDeskJWEHS256Client("https://api.billdesk.com", $clientID, $secretKey);
            $logger = new Logger("default");
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
            $client->setLogger($logger);

    // Prepare the request data
            $payterms=[];
            foreach ($terms as $term){
                array_push($payterms,"TERM_".$term);

            }
            $request = array(
                'mercid' => $merchantID,
                'orderid' => $StudentID.'-'.implode("",$terms)."-2023-LIVE".time(),
                'amount' => $totalamount,
                'order_date' => date_format(new \DateTime(), DATE_W3C),
                'currency' => "356",
                'ru' => "https://tncuicm.com/student/paymentresponse",
                'additional_info' => array(
                    "additional_info1" => $StudentID, //studentID
                    "additional_info2" =>  Auth::user()->email, // student Email
                    "additional_info3" =>  implode(",",$terms), // student selecting and Term payments
                    "additional_info4" => Auth::user()->icm_id, // student ICM ID
                    "additional_info5" => "NA",
                    "additional_info6" => "NA",
                    "additional_info7" => "NA",
                ),
                'itemcode' => "DIRECT",
                'device' => array(
                    'init_channel' => 'internet',
                    'ip' => "$ipaddress",
                    'user_agent' => 'Mozilla/5.0'
                )
            );

            $paymentRequest= new Payment_log();
            $paymentRequest->userid=Auth::user()->id;
            $paymentRequest->sendPayload = json_encode($request);
            $paymentRequest->save();
            $lastInsertId = $paymentRequest->id;
            $request["additional_info"]["additional_info5"]=$lastInsertId;//payment log-id
            $paymentRequest = Payment_log::find($lastInsertId);
            $paymentRequest->sendPayload=$request;
            $paymentRequest->save();
    // Call the createOrder API
            $response = $client->createOrder($request);



    // Handle the response as needed
            if ($response->getResponseStatus() === 200) {
                // Success
                $responseData = $response->getResponse();
                $paymentLogresponse = Payment_log::find($lastInsertId);
                $paymentLogresponse->createapiresponse = json_encode($responseData);
                $paymentLogresponse->save();
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

//    function paymentresponse(Request $request){
//        Log::info("Payment REsponse");
//        Log::info($request);
//
//}
    function paymentreturn(Request $request){
        Log::info("Payment Return");
        Log::info($request);

    }
    //
}
