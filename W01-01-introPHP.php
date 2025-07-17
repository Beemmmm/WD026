<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Welcome to PHP Basic</h1>
    <p>This is a simle PHP application.</p> <hr>
    <h1 style="color: red;"> Basic PHP Syntax </h1>

   <pre>
    &lt;?php
        echo "Hello World";
        ?&gt;
   </pre>

<h3>Result</h3>
<div style="color: blue;">
    <?php
        echo "Hello World <br> ";
        print "<span style='color:pink';> Yonlada Phukphusa";
    ?>
    </div>
    <hr>

    <h1 style="color:red;"> PHP Variables </h1>
       <pre>
    &lt;?php
        $greeting = "World!"
        echo $greeting;
        ?&gt;
   </pre>

<h3>Result</h3>
    <?php
        $greeting = "Hello World!";
        echo"<span style='color:blue;'> $greeting </span>";
        ?>;
<hr>

    <h1 style="color: red;"> Integer Variables Example </h1>
    <?php
    $age = 20;
    echo "<span style ='color: blue';> I am ".$age. " years old </span>";
    echo "<span style ='color: blue';> I am $age years old </span>";
    ?>
<hr>

    <h1 style="color: red;"> Calculat wiht Variables </h1>
    <?php
    $x = 5;
    $y = 4;
    $z = $x+$y;
    echo "<span style = 'color:blue';> The sum of $x and $y is $z </span>";
    ?>
    <hr>

    <h1 style="color: red;"> คำนวณหาพื้นที่สามเหลี่ยม </h1>
    <?php
    $base = 5;
    $hight = 10; 
    $area = 0.5* $base * $hight ;

    echo "<span style = 'color : blue';> พื้นที่ของสามเหลี่ยม คือ $area </span>";
    ?>
    <hr>

    <h1 style="color : red;"> คำนวณอายุ </h1>
    <?php
    $year = 2568;
    $age = 2547;
    $years = $year - $age;
    echo "<span style = 'color : blue;'> อายุของคุณคือ $years ปี</span>";
    ?>
    
    <hr>
    <h1 style="color : blue;"> IF-Else </h1>
    <?php
    $score = 75;
    if($score > 60) {
        echo "คะแนนของคุณคือ $score <br>";
        echo "ผลลัพธ์ : สอบผ่าน";
    }else{
        echo "ผลลัพธ์ : สอบไม่ผ่าน";
    }
    ?>

    <hr>
    <h1 style="color : blue;"> Boolean Variable </h1>
    <?php
    echo "<h3> คุณเป็นนักเรียนใช่หรือไม่ </h3>";
    !$is_student = true;
    if($is_student){
    echo "ใช่";
    }else{
    echo "ไม่ใช่";
    }
    ?>

    <hr>
    <h1 style="color : blue;"> Loop </h1>
    <h2>===== Loop for =====</h2>
    <h3> แสดงตัวเลข 1 ถึง 10 </h3>
    <?php
    $sum = 0;
    for ($i=5 ;$i <= 9 ; $i++){
        $sum += $i;
        if($i < 9){
        echo "$i + ";    
        } else {
            echo "$i = $sum";
        }
    }
        echo "<br> ผลบวกของตัวเลข 5 ถึง 9 คือ $sum ";
    ?>

<hr>
    <h2>===== สูตรคูณแม่ 2 =====</h2>
    <?php
    $j=1;
    while($j <= 12) {
        echo "2 x $j = " . (2 * $j) . "<br>" ;
        $j++;
    }
    ?>

    <hr>
     <h2>===== สูตรคูณแม่ 2 ใส่ตาราง =====</h2>

     <table class = "table table-bordered table-striped w-auto mx-auto text-center">
        <thead class="table-primary">
            <tr>
                <th> ลำดับ </th>
                <th> สูตรคูณ </th>
                <th> ผลลัพธ์ </th>
            </tr>
        </thead>
        <body>
            <?php
            for($i=1; $i <= 12; $i++){
                echo "<tr>";
                echo "<td> $i </td>";
                echo "<td> 2 x $i </td>";
                echo "<td>" .(2 * $i). "</td>";
                echo "</tr>";
            }
            ?>

        </body>
     </table>



    <!-- ======================================================== -->
    <!-- ======================================================== -->
    <!-- ======================================================== -->
    <!-- ======================================================== -->

    <hr>
    <h2>สร้างตัวแปรอาเรย์ แบบที่ 1: Indexed Array</h2>
    <h5>PHP จะกำหนด index เป็นตัวเลขอัตโนมัติ โดยเริ่มจาก 0</h5>
    <hr>

    <?php
        $fruits = ["Apple", "Banana", "Cherry"];
    ?>

     <h3>แสดงรายการผลไม้ โดยใช้ index</h3>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
     <?php
        echo $fruits[0] . "<br>"; //Apple
        echo $fruits[1] . "<br>"; //Banana
        echo $fruits[2] . "<br>"; //Cherry
     ?>
    </div>
<br>
     <div style="color:Red; background-color: lightgray; padding: 10px;">
     <?php
     echo "รายการผลไม้ <br> ";
     echo "ผลไม้ที่1: ",$fruits[0] , "<br>" , "ผลไม้ที่3: " , $fruits[2];
     ?>
     
    </div>
<br>

        <!-- ======================================================== -->
    <br>
    <h4>แสดงรายการผลไม้ โดยใช้ print readable</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            echo "รายการผลไม้: <br>";
            print_r($fruits); // แสดงผลอาเรย์ทั้งหมด  print readable
            echo "<br>";

        ?>
    </div>

       <!-- ======================================================== -->
    <br>
    <h4>แสดงจำนวนสมาชิกในอาร์เรย์</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            echo "จำนวนผลไม้: " . count($fruits) . "ชนิด <br>";
            echo "<br>";

        ?>
    </div>
    
      <!-- ======================================================== -->
    <br>
    <h4>แสดงรายการผลไม้ โดยใช้ implode เพื่อแปลงอาเรย์เป็นสตริง</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // แสดงรายการผลไม้และจำนวนสมาชิกในอาเรย์
            // ใช้ implode เพื่อแปลงอาเรย์เป็นสตริง และแสดงผลลัพธ์
            echo "รายการผลไม้: " . implode(", ", $fruits) . "<br>"; // ผลลัพธ์: Apple, Banana, Cherry
            echo "<br>";
        ?>
    </div>
    
     <!-- ======================================================== -->
    <br>
    <h4>แสดงรายการผลไม้ ใช้คำสั่ง foreach เพื่อวนลูป</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // ใช้คำสั่ง foreach เพื่อวนลูปค่าใน array ทีละตัว โดยในแต่ละรอบ ตัวแปร $fruit จะเก็บค่าผลไม้ 1 ชนิด
            foreach ($fruits as $fruit){
                echo "ผลไม้: $fruit <br>";
            }

            echo "<br>";
        ?>
    </div>

    <div style="color:Red; background-color: lightgray; padding: 10px;">
        <?php
            echo "แสดงรายการผลไม้ทั้งหมด ";
            foreach ($fruits as $fruit)
           if ($fruit == end($fruits)){
            echo "$fruit.";
           }else {
            echo "$fruit, ";
           }
            echo "<br>";
        ?>
    </div>
    
           <!-- ======================================================== -->
    <!-- ======================================================== -->
        
        <hr>
        <h2>สร้างตัวแปรอาเรย์ แบบที่ 2: Associative Array</h2>
        <h6>เป็น array ซ้อนกันหลายชุด (Multidimensional array)</h6>
        <h6>แต่ละชุดเป็น associative array ที่ระบุชื่อ key ชัดเจน เช่น "name" และ "price"</h6>
        <h6>ใช้สำหรับเก็บข้อมูลที่มีความสัมพันธ์กัน key => value เช่น รายการสินค้า</h6>


        <?php
            // สร้างอาเรย์ของผลไม้ที่มีชื่อและราคา
            $products = [
                ["name" => "Apple", "price" => 30],
                ["name" => "Banana", "price" => 20],
                ["name" => "Cherry", "price" => 15]
            ];
        ?>

         <!-- ======================================================== -->
    <br>
    <h4>แสดงรายการผลไม้ ใช้คำสั่ง key value</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // แสดงผลลัพธ์ของการเข้าถึงข้อมูลในอาเรย์
            echo $products[0]["name"] . "<br>";  // Apple
            echo $products[2]["price"] . "<br>"; // 15
    
        ?>
    </div>

    <h4>แสดงรายการผลไม้ ใช้คำสั่ง foreach เพื่อวนลูป</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
        $total_price = 0;
            // ใช้คำสั่ง foreach เพื่อวนลูปค่าใน array ทีละตัว โดยในแต่ละรอบ ตัวแปร $fruit จะเก็บค่าผลไม้ 1 ชนิด
            foreach ($products as $product){
                echo "สินค้า: $product[name] . ราคา: . $product[price] <br>";
                $total_price += $product["price"]; //คำนวณราคารวม
            }

            echo "ราคารวมของผลไม้ทั้งหมด" , $total_price , "บาท";
            echo "<br>";
        ?>
    </div>
        

        <hr>
    <a href="index.php"> Home </a>
</body>
</html>