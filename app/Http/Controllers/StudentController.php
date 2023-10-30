<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Mtr_Icm;
use App\Models\Payment_log;
use App\Models\StudentParams;
use App\Models\Payments;
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


    function paymentview(){

        $studentDatas = StudentParams::select('id','arrn_number')->where('user_id', Auth::user()->id)->where('status',1)->get();

        $icm = Mtr_icm::where('id',Auth::user()->icm_id)->first();

        return view("student.paymentview",compact('studentDatas','icm'));

    }

    function paymentpending(){

        $studentselected = StudentParams::where('user_id',Auth::user()->id)->first();
        $student_id = $studentselected['id'];

        $amountpaid = Invoice::where('student_id', $student_id)->where('payment_status', 1)->sum('amount');
        $balancetopay = 18750 - $amountpaid;
        if($balancetopay < 0){
            $balancetopay = 0;
        }
        if($amountpaid == 0){
            $amountpaid = "NA";
        }else{
            $amountpaid = $this->moneyFormatIndia($amountpaid);
        }
        return view("student.paymentpending",compact('amountpaid','balancetopay')); 

    }


    function storeinvoice(Request $request){

        $studentselected = StudentParams::where('user_id',Auth::user()->id)->first();
        $student_id = $studentselected['id'];

        $invoicedetails = Invoice::where('student_id', $student_id)->where('payment_status', 1)->sum('amount');

        if($invoicedetails > 18750 || $invoicedetails == 18750){
            return redirect()->back()->with('error', 'Already paid the full amount');
        }

        //dd($invoicedetails);

        $actualinv = Auth::user()->invoiceNo+1;
        $invoiceNo = 'PAY_'.Auth::user()->id.'-'.Auth::user()->invoiceNo+1;
        $reqtotal = $request->termamount;
        $total = $reqtotal + $invoicedetails;
        $remaining = 18750 - $invoicedetails;
       // dd($total);
        if($reqtotal > 18750){
            return redirect()->back()->with('error', 'Total amount should not exceed 18,750 ');
        }
        if($total > 18750){
            return redirect()->back()->with('error', 'Student Already paid '.$invoicedetails.' amount remaining balance to pay '.$remaining);
        }

        $invoice = new Invoice;
        $invoice->invoiceNo = $invoiceNo;
        $invoice->payment_mode = "ONLINE";
        $invoice->student_id = $student_id;
        $invoice->term = "TERM";
        $invoice->amount = $reqtotal;
        $invoice->save();

        $user = User::where('id',Auth::user()->id)->first();
        $user->invoiceNo = $actualinv;
        $user->update();

        $student = StudentParams::where('user_id',Auth::user()->id)->first();
       
        if(is_null($student->admission_number) || empty($student->admission_number)){

            $gender = "F";

            if($student->gender == "Male"){
                $gender = "M";
            }
    
            $icmname = Mtr_icm::where('id',$student->icm)->first();
            $short_name =  $icmname['short_name'];
            $admission_count =  $icmname['admission_count'];
            $admission_number = $short_name.date("Y").$gender.'AN'.sprintf("%03d", $admission_count);
            $student->admission_number = $admission_number;
            $student->update();

            $icmname->admission_count = $admission_count+1;
            $icmname->update();
        }
        return redirect('/student/paymentverify/'.$invoiceNo);

    }


    function paymentverify(Request $request){

        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $amount = Invoice::where('invoiceNo', $request->invoiceNo)->sum("amount");
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $invoicedetails[0]['created_at'];
 
       
        return view("student.paymentverify",compact('amount','invoiceNo','invoiceDate'));

    }

    function moneyFormatIndia($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    function printinvoice(Request $request){

        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $studentData = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
        $icm = Mtr_icm::where('id',$studentData->icm)->first();

        $data['invoicedetails'] = $invoicedetails;
        $data['studentData'] = $studentData;
        $data['icm'] = $icm;
        $pdf = Pdf::loadView('icm.printinvoice',compact('studentData','invoicedetails','icm'));

        return $pdf->download($studentData->admission_number.'_invoice_'.$request->invoiceNo.'.pdf');

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
        $payment_id = $payloadData["additional_info"]["additional_info6"];
        $paymentlogs ->response = $token;
        $paymentlogs->save();
        if($payloadData["transaction_error_type"]=="success" && $payloadData["auth_status"]== "0300" ){
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            if ($Student) {

                $returnMessage="SUCCESS";
                $transaction_date=$payloadData["transaction_date"];
                $transactionid=$payloadData["transactionid"];
                $amount=$payloadData["amount"];

                $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
                $studentData = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
                $icm = Mtr_icm::where('id',$studentData->icm)->first();

                $payments = Payments::where('id', $payment_id)->first();
                $payments->status = $returnMessage;
                $payments->transaction_date = $payloadData["transaction_date"];
                $payments->transactionid = $payloadData["transactionid"];
                $payments->update();
        
                $data['invoicedetails'] = $invoicedetails;
                $data['studentData'] = $studentData;
                $data['icm'] = $icm;
                $pdf = Pdf::loadView('icm.printinvoice',compact('studentData','invoicedetails','icm'));
        
                // return $pdf->download($studentData->admission_number.'_invoice_'.$request->invoiceNo.'.pdf');
                
                return   view("student.paymentverify" ,compact("returnMessage" , "transactionid","transaction_date","amount"));
            } else {
                return back()->withErrors(['email' => 'Invalid credentials']); // Authentication failed
            }

        }
        elseif ($payloadData["auth_status"]== "0002")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];


            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->transaction_date = $payloadData["transaction_date"];
            $payments->transactionid = $payloadData["transactionid"];
            $payments->update();
            
            return   view("student.paymentverify" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        elseif ($payloadData["auth_status"]== "0399")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->transaction_date = $payloadData["transaction_date"];
            $payments->transactionid = $payloadData["transactionid"];
            $payments->update();

            return   view("student.paymentverify" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        else{
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->update();

            return   view("student.paymentverify" ,compact("returnMessage"));
        }


//        return $decodedPayload;

    }
    function payment(Request $request)
    {

        if(Auth::user()->otp_verified == 0){
            return redirect('login')->with('error', 'OTP not verified');
        }

        $invoiceNo = $request->invoiceNo;
        $amount=0;
        $amount = Invoice::where('invoiceNo', $request->invoiceNo)->sum('amount');
        $student=StudentParams::where("status",'1')->where("user_id",Auth::user()->id)->get();
        if(count($student)==1) {
            $MerchantID = "TMLNDUCOUN";
            $ClientID = "tmlnducoun";
            $responseurl = "https://tncuicm.com/student/paymentresponse";
          //  $secretkey = 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4';  //Developement
            $secretkey = 'nBxE5Uw4i0hGZQia2dETrVAV1KrxALaB';  //Production
            $returnURL = "https://tncuicm.com/student/paymentreturn";
            $billdesk_URL = "https://api.billdesk.com/payments/ve1_2/orders/create";
            $transaction_id=$student[0]->arrn_number."-".time();
            $totalamount=$amount;
            $date_atom =date("dd-mm-yyyy h:i:s");
            $StudentID=$student[0]->id;
            $userId=Auth::user()->id;
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
           
            $request = array(
                'mercid' => $merchantID,
                'orderid' => $StudentID.'-2023-LIVE'.time(),
                'amount' => $totalamount,
                'order_date' => date_format(new \DateTime(), DATE_W3C),
                'currency' => "356",
                'ru' => "https://tncuicm.com/student/paymentresponse",
                'additional_info' => array(
                    "additional_info1" => $userId, //userId
                    "additional_info2" =>  Auth::user()->email, // student Email
                    "additional_info3" =>  $amount, // student selecting and Term payments
                    "additional_info4" => Auth::user()->icm_id, // student ICM ID
                    "additional_info5" => "NA",
                    "additional_info6" =>  "NA",
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

            $payments= new Payments();
            $payments->student_id = $StudentID;
            $payments->user_id = Auth::user()->id;
            $payments->invno = $invoiceNo;
            $payments->mercid = $merchantID;
            $payments->orderid = $StudentID.'-2023-LIVE'.time();
            $payments->amount = $totalamount;
            $payments->order_date = date("Y-m-d");
            $payments->status = "INITIATED";
            $payments->save();

            $request["additional_info"]["additional_info6"]= $payments->id;//payment log-id

            $response = $client->createOrder($request);

            $getinvoice = Invoice::where('invoiceNo', $invoiceNo)->first();
            $getinvoice->payment_id = $payments->id;
            $getinvoice->update();

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
