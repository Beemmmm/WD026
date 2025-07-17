<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic</title>
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

</body>
</html>
