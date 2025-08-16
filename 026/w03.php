<?php
    $year = date("Y") + 543;
    echo "ปีปัจจุบันและปีย้อนหลัง 20 ปี <br>";
    $i = 0;
        while ($i <= 20) {
            $currentYear = $year - $i;
            echo "ปี $currentYear<br>";
            $i++;
        }
    echo "<br>เลือกปีจากกล่องรายการ <br>";
    echo "<select>";
        for ($i = 0; $i <= 20; $i++) {
            $currentYear = $year - $i;
            echo "<option value='$currentYear'>ปี $currentYear</option>";
        }
    echo "</select>";
    echo "<br>แสดงปี 20 ปีย้อนหลัง <br>";
        $j = 0;
        do {
            $currentYear = $year - $j;
            echo "ปี $currentYear<br>";
            $j++;
        } while ($j <= 20);
?>