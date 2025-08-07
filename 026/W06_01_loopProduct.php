<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Lppp for Show Product </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    
    <style>
        .container {
            max-width: 800px;;
        }
    </style>
</head>
<body>

<?php
    $products = [
    ['id'=>1001, 'name'=>'Apple',     'price'=>60, 'quantity'=>50],
    ['id'=>1002, 'name'=>'Banana',    'price'=>20, 'quantity'=>30],
    ['id'=>1003, 'name'=>'Orange',    'price'=>30, 'quantity'=>25],
    ['id'=>1004, 'name'=>'Mango',     'price'=>45, 'quantity'=>40],
    ['id'=>1005, 'name'=>'Pineapple', 'price'=>60, 'quantity'=>15],
    ['id'=>1006, 'name'=>'Kiwi',      'price'=>55, 'quantity'=>20],
    ['id'=>1007, 'name'=>'Grapes',    'price'=>25, 'quantity'=>60],
    ['id'=>1008, 'name'=>'Strawberry','price'=>40, 'quantity'=>35],
    ['id'=>1009, 'name'=>'Blueberry', 'price'=>50, 'quantity'=>45],
    ['id'=>1010, 'name'=>'Watermelon','price'=>70, 'quantity'=>10],
    ['id'=>1011, 'name'=>'Papaya',    'price'=>60, 'quantity'=>60],
    ['id'=>1012, 'name'=>'Peach',     'price'=>50, 'quantity'=>40],
    ['id'=>1013, 'name'=>'Plum',      'price'=>38, 'quantity'=>50],
    ['id'=>1014, 'name'=>'Lemon',     'price'=>15, 'quantity'=>75],
    ['id'=>1015, 'name'=>'Coconut',   'price'=>45, 'quantity'=>30],
    ];

   // foreach ($products as $product){
   //             echo "รหัสสินค้า " . $product['id']." สินค้า: ".$product["name"]. "ราคา: " .$product["price"] . " บาท ","จำนวน: " .$product["quantity"] ." ชิ้น<br>";
                
    //} 
    
?>

<div class="container mt-5">
    <h1>Product List</h1>

    <form action="" method="post" class="mb-3">
        <div>
            <input type="number" name="price" placeholder="Enter Price" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>

    </form>

    <table id ="productTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>


    <?php

        // Check if form is submitted
        if(isset($_POST['price']) && !empty($_POST['price'])) {
            $filterPrice = $_POST['price'];
            $filterProducts = array_filter($products, function($product) use ($filterPrice){
                return $product['price'] == $filterPrice;
            });

            // คืนค่า array ใหม่ โดยรีเซ็ต index ให้เริ่มที่ 0
            $filterProducts = array_values($filterProducts);

        }else{
            $filterProducts = $products;
        };

    foreach ($filterProducts as $index => $product){
        
        echo "<tr>";
        echo "<td>".($index+1). "</td>"; 
        echo "<td>".$product['id']. "</td>"; 
        echo "<td>".$product['name']. "</td>";
        echo "<td>".$product['price']. "</td>";
        echo "<td>".$product['quantity']. "</td>";
        echo "</tr>";
    } 
    ?>

        </tbody>
    </table>
</div>

<script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let table = new DataTable('#productTable');
</script>

</body>
</html>