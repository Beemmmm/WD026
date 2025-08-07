<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Odd Even number </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Odd Even Number Checker</h1>
        <hr>
        <p class="text-center">กรุณากรอกตัวเลขเพื่อทำการตรวจสอบเลขคู่เลขคี่</p>

    <form action="" method="post" class="text-center">
        <div class="form-group">
        <input type="number" name="number" id="number" class="form-control w-50 mx-auto" placeholder="Enter a number" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3"> Check </button>
    </form>


    <?php
    $get_number = $_POST['number'] ?? null;
    if($get_number %2==0){
        echo "<h3 class='text-success text-center'> The number $get_number is an even numbe </h3>";
    }else{
        echo "<h3 class='text-danger text-center'>The number $get_number is an odd number </h3>";
    }
    ?>
    <hr>
    <a href="index.php">Home</a>
</div>
    
</body>
</html>