<!DOCTYPE html> 
<html> 
    <head> 
        <style> 
            table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px; } td { border: 1px solid #dddddd; text-align: left; padding: 20px; } tr:nth-child(even) { background-color: #dddddd; } h3,h4,.slno{ text-align: center; } th{ background-color: black; color: #fff; text-align: center; border: 1px solid #dddddd; padding: 20px; font-size: 10px !important;} 
        </style>
    </head>
<body> 
    <h3>CONTACT DETAILS OF DIPLOMA IN COOPERATIVE MANAGEMENT 2023-24</h3> 
    <h4>Tamil Nadu Cooperative Union</h4> <h4>{{$studentDatas[0]->mtr_icm->icm_name}}</h4> 
    <table> 
        <tr> 
            <th style="width:5%" class="slno">SlNo</th> 
            <th style="width:15%">ARN Number</th> 
            <th style="width:20%">Full name</th> 
            <th style="width:10%">MobileNo</th>
            <th style="width:50%">Address</th> 
        </tr> 
        <tbody>
            <?php
            $count = 1;
            ?>
            @foreach ($studentDatas as $studentData)
                <tr>
                    <td style="width:5%" class="slno">{{$count++}}</td>
                    <td style="width:15%" class="slno">{{$studentData->arrn_number}}</td>
                    <td style="width:20%" class="slno">{{$studentData->fullname}}</td>
                    <td style="width:10%" class="slno">{{$studentData->mobile1}}</td>
                    <td style="width:50%" class="slno">{{$studentData->plotno}}, {{$studentData->streetname}}, {{$studentData->city}}, {{$studentData->district}}, {{$studentData->state}}, {{$studentData->pincode}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
