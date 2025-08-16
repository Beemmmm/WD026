<?php
	$acctype ="S";
	$amount = 2500000;
    
    switch ($acctype) {
        case 'S':
            if ($amount < 1000000) {
                $rate = 1.5;
            } else {
                $rate = 1.75;
            }
            break;

        case '3':
            $rate = 2.0;
            break;

        case '6':
            $rate = 2.25;
            break;

        case 'Y':
            $rate = 2.5;
            break;

        default:
            $rate = 0;
            break;
    }
    $display_amount = intval($amount / 1000000);
    echo "ประเภทบัญชีเงินฝาก ‘",$acctype,"’  จำนวนเงินฝาก $display_amount ล้านบาท<br>";
    echo "ท่านได้รับอัตราดอกเบี้ยร้อยละ $rate";
 
?>