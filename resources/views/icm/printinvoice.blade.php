<!DOCTYPE html>
<html>
<head>
    <title>Tamil Nadu Cooperative Union</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:60px;        
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h2 class="text-center m-0 p-0">Tamil Nadu Cooperative Union</h2>
</div>
<div class="head-title">
    <h2 class="text-center m-0 p-0">INVOICE</h2>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice No. - <span class="gray-color">{{$invoicedetails[0]->invoiceNo}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Invoice Date - <span class="gray-color">{{date("d-m-Y",strtotime($invoicedetails[0]->created_at))}}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
        {{-- <img src="https://techsolutionstuff.com/frontTheme/assets/img/logo_200_60_dark.png" alt="Logo"> --}}
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><b>{{  $icm->icm_name }}</b></p>
                    <p style="line-height: 1.6;">{{ $icm->add1.", ".$icm->add2 }}</p>
                    <p style="line-height: 1.6;">{{ $icm->city.", ".$icm->pincode }}</p>                    
                    <p>Contact: {{ $icm->contact }}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><b>{{$studentData->fullname}}</b></p>
                    <p style="line-height: 1.6;">{{$studentData->plotno.", ".$studentData->streetname.", ".$studentData->city}}</p>
                    <p style="line-height: 1.6;">{{$studentData->district.", ".$studentData->state.", ".$studentData->pincode}}</p>            
                    <p>Contact: {{$studentData->mobile1}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
          <th class="w-50">Sno.</th>
          <th class="w-50">Description</th>
          <th class="w-50">Quantity</th>
          <th class="w-50">Price</th>
          <th class="w-50">Total</th>
        </tr>
        <?php
        $total = 0;
        $count = 0;
        foreach($invoicedetails as $invoicedetail){
        ?>
            <tr align="center">
                <td>{{++$count}}</td>
                <td>
                    {{$invoicedetail->term}}
                </td>
                <td style="text-align: center">
                01
                </td>
                <td style="text-align: center">
                    {{number_format((float)$invoicedetail->amount, 2, '.', '');}}
                </td>
                <td style="text-align: center">
                    {{number_format((float)$invoicedetail->amount, 2, '.', '');}}
                </td>
            </tr>
        <?php
          $total += $invoicedetail->amount;
        }

        $number = $total;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            "." . $words[$point / 10] . " " . 
                $words[$point = $point % 10] : '';
        $amountinrupees = $result . "Rupees Only";
        ?>
        <tr>
            <td colspan="5">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{number_format((float)$total, 2, '.', '');}}</p>
                        <p>{{number_format((float)$total, 2, '.', '');}}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
<div class="add-detail mt-10" style="font-size: 12px !important">
    <div class="w-100 float-left mt-10">
       <b> Amount in words: </b> {{ucfirst($amountinrupees)}}
    </div>
</div>
<br>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            {{-- <th class="w-50">Shipping Method</th> --}}
        </tr>
        <tr>
            <th class="w-50">{{$invoicedetails[0]->payment_mode}}</th>
            {{-- <td>Free Shipping - Free Shipping</td> --}}
        </tr>
    </table>
</div>
<div class="add-detail mt-10" style="font-size: 10px !important">
    <div class="w-50 float-left mt-10">
        Terms & Conditions:
        <p>1. Once amount paid cannot refundable.</p>
    </div>
</div>
</html>