<?php
	$acctype ="S";
	$amount = 2500000;
    
    if ($acctype == "S") {
        if ($amount < 1000000) {
            $rate = 1.5;
        } else {
            $rate = 1.75;
        }
    } else if ($acctype == "3") {
        $rate = 2.0;
    } else if ($acctype == "6") {
        $rate = 2.25;
    } else if ($acctype == "Y") {
        $rate = 2.5;
    } 
    $display_amount = intval($amount / 1000000);
    echo "ประเภทบัญชีเงินฝาก ‘",$acctype,"’  จำนวนเงินฝาก $display_amount ล้านบาท<br>";
    echo "ท่านได้รับอัตราดอกเบี้ยร้อยละ $rate";
 
?>
