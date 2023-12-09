<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    $selectQuery = 'SELECT
        tborders.order_id,
        tborders.product_id,
        tborders.order_product_size,
        tbproducts.product_name,
        tbproducts.product_price,
        tborders.user_id,
        tbusers.user_username,
        tborders.order_quantity,
        tborders.order_price,
        tborders.order_payment_method,
        tborders.order_address,
        tborders.order_date,
        tborders.order_arrival_date,
        tborders.order_status
    FROM
        tborders
    INNER JOIN
        tbproducts ON tborders.product_id = tbproducts.product_id
    INNER JOIN
        tbusers ON tborders.user_id = tbusers.user_id
    WHERE
        tborders.order_id LIKE "%' . $search . '%"
        OR tbproducts.product_name LIKE "%' . $search . '%"
        OR tbusers.user_username LIKE "%' . $search . '%"
        OR tborders.order_quantity LIKE "%' . $search . '%"
        OR tborders.order_price LIKE "%' . $search . '%"
        OR tborders.order_payment_method LIKE "%' . $search . '%"
        OR tborders.order_address LIKE "%' . $search . '%"
        OR tborders.order_date LIKE "%' . $search . '%"
        OR tborders.order_arrival_date LIKE "%' . $search . '%"
        OR tborders.order_status LIKE "%' . $search . '%"
        OR tborders.order_product_size LIKE "%' . $search . '%"';
        
    $result = $conn->query($selectQuery);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/sales.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>Vulcan - Sales</title>
</head>
<body>
<div class="sale-container">
        <?php include("../php/dashboard.php"); ?>
        <div class="container">
                <h1 class="title">Sales</h1>
             <div class="table-actions">
                    <div class="product-search">  
                        <select name="filter" id="filter">
                            <option value="Returned">Returned</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled"></option>
                        </select>                      
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <form method="GET" action="" id="searchForm">
                            <input type="search" name="search" placeholder="Search Items..."  value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">                            
                        </form>
                    </div>                   
                </div>
                <!--Table-->
                <div class="product-table">
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Quantity</th>
                        <th>Price Per Product</th>
                        <th>Subtotal</th>
                        <th>Payment Method</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Order Arrived Date</th>
                        <th>Order Status</th>
                    </tr>
                    <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['order_id'] . '</td>';
                            echo '<td>' . $row['product_id'] . '</td>';
                            echo '<td>' . $row['product_name'] . '</td>';
                            echo '<td>' . $row['order_product_size'] . '</td>';
                            echo '<td>' . $row['user_id'] . '</td>';
                            echo '<td>' . $row['user_username'] . '</td>';
                            echo '<td>' . $row['order_quantity'] . '</td>';
                            
                            
                            // Calculate and display price per product
                            $pricePerProduct = $row['order_price'] / $row['order_quantity'];
                            echo '<td>' . $pricePerProduct . '</td>';
                            echo '<td>' . $row['order_price'] . '</td>';
                            echo '<td>' . $row['order_payment_method'] . '</td>';
                            echo '<td>' . $row['order_address'] . '</td>';
                            echo '<td>' . $row['order_date'] . '</td>';
                            echo '<td>' . $row['order_arrival_date'] . '</td>';
                            echo '<td>' . $row['order_status'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>  
</body>
</html>