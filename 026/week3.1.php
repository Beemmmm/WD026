<?php
    $day = array("วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์",
    "วันเสาร์","วันอาทิตย์");
    $sale = array(24000,27000,25000,28000,32000,35000,30000);
    $n = sizeof($day);
    $totalSales = 0;
    $averageSales = 0;
    for($i=0;$i<7;$i++){
    echo "<br>วัน $day[$i] มียอดขาย ", number_format($sale[$i]) ," บาท ";
    $totalSales += $sale[$i];
    } if($n >0){
        $averageSales = $totalSales / $n;
    }
    echo "<br><br>ยอดขายรวมทั้งสัปดาห์ ",number_format($totalSales ,2)," บาท<br>";
    echo "ยอดขายเฉลี่ย คือ ", number_format($averageSales,2) ," บาท";

?>