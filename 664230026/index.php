<?php
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> รายการนักศึกษา </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <style>
        .container {
            max-width: 800px;
            ;
        }
    </style>
</head>

<body>

    <?php
    $sql = "SELECT * FROM td_664230026";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container mt-5">
        <h1>รายการนักศึกษา</h1>

        <form action="" method="post" class="mb-2">
                <a href="WB026.php" class="btn btn-danger"> เพิ่มนักศึกษา </a>
        </form>

        <table id="productTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Created At</th>

                </tr>
            </thead>
            <tbody>


                <?php

                // Check if form is submitted
                if (isset($_POST['std_id']) && !empty($_POST['std_id'])) {
                    $filterPrice = $_POST['std_id'];
                    $filtertd_664230026 = array_filter($td_664230026, function ($td_664230026) use ($filterPrice) {
                        return $td_664230026 ['std_id'] == $filterPrice;
                    });

                    // คืนค่า array ใหม่ โดยรีเซ็ต index ให้เริ่มที่ 0
                    $filtertd_664230026 = array_values($filtertd_664230026);

                } else {
                    $filtertd_664230026 = $data;
                }

                foreach ($filtertd_664230026 as $index => $td_664230026) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $td_664230026['std_id'] . "</td>";
                    echo "<td>" . $td_664230026['f_name'] . "</td>";
                    echo "<td>" . $td_664230026['L_name'] . "</td>";
                    echo "<td>" . $td_664230026['mail'] . "</td>";
                    echo "<td>" . $td_664230026['tel'] . "</td>";
                    echo "<td>" . $td_664230026['address'] . "</td>";
                    echo "<td>" . $td_664230026['created_at'] . "</td>";
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