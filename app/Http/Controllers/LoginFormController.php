<?php

namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Log;
Use Redirect;

class LoginFormController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    function index(){
        return view("icm.login");
    }

    function checklogin(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
     
        //dd(Hash::make($credentials['password']));
        if (Auth::attempt($credentials)) {

            if(Auth::user()->forcePasswordChange == 1){
                return redirect()->intended('/icm/passwordChange')
                ->withSuccess('Signed in');
            }else{
                if(Auth::user()->role == 1){
                    return redirect()->intended('/icm/dashboard')
                    ->withSuccess('Signed in');
                }else if(Auth::user()->role == 2){
                    return redirect()->intended('/icm/icmdashboard')
                            ->withSuccess('Signed in');
                }
                else if(Auth::user()->role == 3){

                      $smsresponse = $this->sendotp(Auth::user()->phone);
                      Log::info("**smsresponse**");
                      Log::info($smsresponse);
                      if($smsresponse){
                        return redirect()->intended('/icm/otpscreen')
                        ->withSuccess('OTP sent Successfully');
                      }else{
                        return redirect('login')->with('error', $smsresponse);
                      }
                    // return redirect()->intended('/student/studentdashboard')
                    //     ->withSuccess('Signed in');
                }
            }
        }
        return Redirect::back()->with('error', 'Login details are not valid');
    }

    public function sendotp($mobilenumber) {

        $otp = $this->generateNumericOTP(6);

        $TEMPLATE_ID = __('1107169417061551211');
        $SMSAPIKEY = "jUdpsmb5V7WIR8zdirW+By1lzoxHFgunMlUwJsjz70g=";
        $SMSCLIENTID = "1c590c3e-ac8b-495a-a355-d184b432a9e8";

        //message
        $message = 'Your OTP for tncuicm.com registration is {var} -TAMILNADU COOPERATIVE UNION';
        $message = str_replace("{var}",$otp,$message);
        $curl = curl_init();

        Log::info("http://sms.dial4sms.com/api/v2/SendSMS?SenderId=TNCUCO&Message='.urlencode($message).'&MobileNumbers='.$mobilenumber.'&TemplateId='.urlencode($TEMPLATE_ID).'&ApiKey='.urlencode($SMSAPIKEY).'&ClientId='.urlencode($SMSCLIENTID)");
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sms.dial4sms.com/api/v2/SendSMS?SenderId=TNCUCO&Message='.urlencode($message).'&MobileNumbers='.$mobilenumber.'&TemplateId='.urlencode($TEMPLATE_ID).'&ApiKey='.urlencode($SMSAPIKEY).'&ClientId='.urlencode($SMSCLIENTID),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        Log::info("**response**");
        Log::info($response);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        curl_close($curl);
        
        if (isset($error_msg)) {
            return "Something went wrong on sending OTP";
        }else{
            $response = json_decode($response, true);
            if($response['ErrorCode'] == 0 && is_null($response['ErrorDescription'])){
                
                User::where('id', Auth::user()->id)
                        ->update(['otp_verified' => 0, 'otp_sent' => $otp]);

                $message = $response['Data'][0]['MessageErrorDescription'];
                Log::info("**message**");
                Log::info($message);
                return $message;
            }else{
                return "Something went wrong on sending OTP";
            }
        }
    }

    // Function to generate OTP 
    function generateNumericOTP($n) { 
      
        // Take a generator string which consist of 
        // all numeric digits 
        $generator = "135792468"; 
    
        // Iterate for n-times and pick a single character 
        // from generator and append it to $result 
        
        // Login for generating a random character from generator 
        //     ---generate a random number 
        //     ---take modulus of same with length of generator (say i) 
        //     ---append the character at place (i) from generator to result 
    
        $result = ""; 
    
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
    
        // Return result 
        return $result; 
    } 

    public function verifyotp(Request $request) {
        return redirect('verifyotp');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('login');
    }

    public function passwordupdateforrolethree() {
       $userslist = User::where('role', 3)->where('forcePasswordChange', 0)->get();

       foreach($userslist as $user){

        $userid = $user->id;
        $phone = $user->phone;
        User::where('id', $userid)
        ->update(['password' => Hash::make($phone), 'forcePasswordChange' => 1]);

       }

       return "success";
    }

}
