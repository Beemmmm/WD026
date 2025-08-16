<?php
    $con = array("PHP"=>0.54,"IDR"=>2.11,"VND"=>1.45,"INR"=>0.38,"CHF"=> 36.05,
    "CAD"=>23.56,"
NZD"=>19.45,"SEK"=>3.03,"DKK"=>5.05,"NOK"=>3.06);
    $num = sizeof($con);
    foreach($con as $con=>$rate){
        echo "<br>สกุลเงิน $con อัตราแลกเปลี่ยนประจำวัน $rate บาท ";
        }
?>