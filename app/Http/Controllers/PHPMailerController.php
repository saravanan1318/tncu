<?php

namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\StudentParams;

class PHPMailerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    public function composeEmail($id) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            $logo1 = "images/log.png";
            $logo2 = "images/tncu-logo.png";

            $Studentdetails = StudentParams::where('id',$id)->first()->toArray();

           // dd($Studentdetails);

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'saravanan13395@gmail.com';   //  sender username
            $mail->Password = 'kwhlzjxmgiiidstg';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465
            $mail->AddEmbeddedImage($logo1, 'logo1');
            $mail->AddEmbeddedImage($logo2, 'logo2');

            $mail->setFrom('no-reply@tncu.com', 'Admin');
            $mail->addAddress($Studentdetails['email']);

            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }


            $mail->isHTML(true);                // Set email content format to HTML



            $message = file_get_contents('emailTemplates/RegistrationAcknowledgementNotificationLink.html', true);
            $message = str_replace("{IMG-LOGO1}", 'cid:logo1', $message);
            $message = str_replace("{IMG-LOGO2}", 'cid:logo2', $message);
            $message = str_replace("{REGISTERED-COURSE}", ' DIPLOMA IN COOPERATIVE MANAGEMENT', $message);
            $message = str_replace("{CANDIDATE-NAME}", ucfirst($Studentdetails['fullname']), $message);
            $message = str_replace("{REGISTERED-NO}", $Studentdetails['arrn_number'], $message);
            $message = str_replace("{REGISTERED-DATE}", $Studentdetails['created_at'], $message);

            $mail->Subject = "TNCU APPLICATION- ".$Studentdetails['arrn_number'];

            $mail->Body    =  $message;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
//                echo "Email not sent.";
               // return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }

            else {
//                echo "Email has been sent.";
              //  return back()->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
//            echo 'Message could not be sent.';
           //  return back()->with('error','Message could not be sent.');
        }
    }
}
