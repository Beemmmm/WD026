<?php
$alst = 168;  
$str = 30;  
$full = intdiv($alst, $str);
$re = $alst % $str;
$ttr = $full + ($re > 0 ? 1 : 0);
echo "<table>";
echo "<tr><td>จำนวนนักศึกษาที่เข้าเรียนสาขาเทคโนโลยีสารสนเทศ</td><td> $alst </td><td>คน</td></tr>";
echo "<tr><td>จำนวนนักศึกษาต่อห้อง</td><td> $str </td><td>คน</td></tr>";
echo "<tr><td>จัดหมู่เรียนได้</td><td> $ttr </td><td>ห้อง</td></tr>";
echo "<tr><td>โดยห้องที่ไม่เต็มมีนักศึกษา</td><td> $re </td><td>คน</td></tr>";
echo "</table>";
?>
