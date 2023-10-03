<?php
$secretKey = $secretKey;
$merchantID = $merchantID;
$bdorderid=$responseData->bdorderid;
$authToken=$responseData->links[1]->headers->authorization;
$returnUrl=$responseData->ru;

?>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule="" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
</head>
<body>
</body>
<script>
    var flow_config = {
        merchantId: "<?=$merchantID?>",
        bdOrderId: "<?=$bdorderid?>",
        authToken: "<?=$authToken?>",
        // authToken: "jhsd",
        childWindow: false,
        returnUrl: "<?=$returnUrl?>",
        //returnUrl: <?php //=$returnUrl?>//,
        retryCount: 0
    };
    var responseHandler = function(txn) {
        if (txn.response) {
            alert("callback received status:: ", txn.status);
            alert("callback received response:: ", txn.response)//response handler to be implemented by the merchant
        }
    };
    var config = {
        flowConfig: flow_config,
        flowType: "payments"
    };
    window.onload = function() {
        // alert("test");
        setTimeout(function() {
            window.loadBillDeskSdk(config);
        }, 0);
    };
</script>
</html>
<?php


///* Billdesk has changed payment gateway. sample as given below */
//
///****
//config.php
// *****/
//
//$MerchantID = "BDUATV2TND";
//$ClientID = "bduatv2tnd";
//$responseurl = "https://www.merchantwebsite.com/ru.php";
//$secretkey = 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4';
//$returnURL = "https://www.merchantwebsite.com/paymentresponse.php";
//$billdesk_URL = "https://pguat.billdesk.io/payments/ve1_2/orders/create";
//$transaction_id=190;
//$totalamount=1;
//$date_atom ="19-10-2023";
//$CustomerID=1;
//$PaymentFor=20;
//$ipaddress= $_SERVER['REMOTE_ADDR'];
//
//
///****
//process.php
// *****/
//require_once 'vendor/autoload.php'; // Adjust the path if necessary
//
//use Firebase\JWT\JWT;
//
////use Jose\Component\Core\JWT;
//$str = "ABCD|ARP10234|NA|94.00|NA|NA|NA|INR|NA|R|abcd|NA|NA|F|NA|NA|NA|NA|NA|NA|NA|http://www.domain.com/response.php";
//print_r(hash_hmac('sha256',$str,$secretkey, false));
////use Jose\Component\Core\JWT;
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//
///*****************************************/
//// Build headers
///*****************************************/
//
//$headers = ["alg" => "HS256", "clientid" => $ClientID, "kid" => "HMAC"];
//
//$payload = [
//    "mercid" => $MerchantID,
//    "orderid" => $transaction_id,
//    "amount" => $totalamount,
//    "order_date" => $date_atom,
//    "currency" => "356",
//    "ru" => $responseurl,
//    "additional_info" => [
//        "additional_info1" => $CustomerID,
//        "additional_info2" => $PaymentFor,
//        "additional_info3" => "NA",
//        "additional_info4" => "NA",
//        "additional_info5" => "NA",
//        "additional_info6" => "NA",
//        "additional_info7" => "NA",
//    ],
//    "itemcode" => "DIRECT",
//    "device" => [
//        "init_channel" => "internet",
//        "ip" => $ipaddress,
//        "accept_header" => "text/html",
//        "user_agent" => "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0",
//      ]
//    ];
//
//
//
//    /*****************************************/
//        // Encode payload
//    /*****************************************/
//
//    $curl_payload = JWT::encode($payload, $secretkey, "HS256", null ,$headers);
//
//    /*****************************************/
//        // Submit to Billdesk
//    /*****************************************/
//    $ch = curl_init( $billdesk_URL );
//$servertimeYYYYMMddHHmmss=date('Y-m-d H:i:s');
//    $ch_headers = array(
//        "Content-Type: application/jose",
//        "accept: application/jose",
//        "BD-Traceid: $transaction_id",
//        "BD-Timestamp: $servertimeYYYYMMddHHmmss"
//    );
//    curl_setopt( $ch, CURLOPT_HTTPHEADER, $ch_headers);
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt( $ch, CURLOPT_POSTFIELDS, $curl_payload);
//    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//
//    $result = curl_exec($ch);
//    curl_close($ch);
//
//    print_r($result);
////    exit();
//
//    /*****************************************/
//        // Billdesk Response
//    /*****************************************/
//
//
//    $launch_billdesk = false;
//    try {
//        $result_decoded = JWT::decode($result, $secretkey, array('HS256'),);
//        $result_array = (array) $result_decoded;
//
//        if ($result_decoded->status == 'ACTIVE') {
//            $transactionid = $result_array['links'][1]->parameters->bdorderid;
//            $authtoken = $result_array['links'][1]->headers->authorization;
//
//            $launch_billdesk = true;   //write js code to launch sdk
//
//        } else { // Response error
//            echo "Response error";
//        }
//
//    } catch (\Exception $e) {
//        echo "<br><br>Return signature validation FAILED: $e";
//    }
//
//
///****
//paymentresponse.php
// *****/
//
////    use Firebase\JWT\JWT;
//
//    /*****************************************/
//        // Read POST data
//    /*****************************************/
//    $tx = "";
//    if(!empty($_POST)) {
//        $tx_array = $_POST;
//        if (isset($tx_array['transaction_response'])) {
//            $tx = $tx_array['transaction_response'];
//        }
//    } else {
//        echo "<br><br>Invalid call<br>";
//        die();
//    }
//
//
//    /*****************************************/
//        // Signature validation
//    /*****************************************/
//    try {
//        $result_decoded = JWT::decode($tx, $secretkey, array('HS256'));
//        $result_array = (array) $result_decoded;
//        $result_json =  json_encode($result_array,JSON_PRETTY_PRINT);
//    } catch (\Exception $e) {
//        //echo $e;
//        echo "<br><br>Invalid response<br>";
//        die();
//    }
//
//    /*****************************************/
//        // Process info
//    /*****************************************/
//    if ($result_decoded->transaction_error_type == 'success') {
//
//        $orderid = $result_decoded->orderid;
//        $transaction_date = $result_decoded->transaction_date;
//        $transactionid = $result_decoded->transactionid;    //payment transaction id
//        $charge_amount = $result_decoded->charge_amount;
//
//        /*  SAVE TO DB and send receipt     */
//        $success = updateTransactionToDB($result_array);
////        GenerateReceiptEmail($orderid, 1, $draftreceipt);
//
//        echo "<h2>Transaction was successful....</h2>";
//        echo "Transaction Date: $transaction_date<br>";
//        echo "Transaction ID: $transactionid<br>";
//        echo "Charge Amount: ₹$charge_amount<br>";
//
//
//    } else { // Error
//        $txerror = $result_decoded->transaction_error_type;
//        $txid = $result_decoded->transactionid;
////        echo "<h2>Transaction FAILED....</h2>";
////        echo "Transaction Date: $transaction_date<br>";
////        echo "Transaction ID: $transactionid<br>";
////        echo "Charge Amount: ₹$charge_amount<br>";
////        echo "Failure Reason: ₹$transaction_error_desc<br>";
//    }


