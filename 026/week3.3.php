<?php
    $emp[0] = array("EE010"," พรทิพย์","ชื่นใจ"," การเงิน",36000);
    $emp[1] = array("E011"," อุดม ","โชคดี"," การตลาด",33500);
    $emp[2] = array("E012"," พิมพ์ชนก ","สุขสันต์"," บัญชี ",30500);
    $emp[3] = array("E013"," กฤษณะ ","เผ่าพันธุ์","ฝ่ายผลิต",29000);
    $emp[4] = array("E014"," ณัฐพล ","ศรีวิไล","ทคโนโลยีสารสนเทศ",40000);
    $numEmployees = count($emp);
    $totalGrossSalary =0;
    $totalTaxDeducted =0;
    $taxrate = 0.03;
    echo "<table border=1>";
    echo "<tr><th>รหัสพนักงาน</th><th>ชื่อ</th><th>นามสกุล</th><th>แผนก</th><th>เงินเดือน</th><th>หักภาษี</th><th>เงินเดือนคงเหลือ</th></tr>";
    for($i=0;$i<$numEmployees;$i++){
        $taxAmount = $emp[$i][4] * $taxrate;
        $netSalary = $emp[$i][4] - $taxAmount;
        echo "<tr><td>",$emp[$i][0],"</td><td>",$emp[$i][1],"</td><td>",$emp[$i][2],"</td><td>",$emp[$i][3],"</td><td>" ,$emp[$i][4] ,"</td><td>",$taxAmount,"</td><td>",$netSalary,"</td></tr><br>";

    }
    echo "</table>";
?>