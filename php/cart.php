<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    $userID = $_SESSION['id'];

    $selectQuery = 'SELECT p.product_name, p.product_image, p.product_price, c.cart_product_size, c.cart_quantity
                FROM tbcarts c
                JOIN tbproducts p ON c.product_id = p.product_id WHERE user_id = '.$userID;

    $query_result = $conn->query($selectQuery);
    foreach ($query_result as $row) {
        $productName = $row['product_name'];
        $productImage = $row['product_image'];
        $productPrice = $row['product_price'];
        $productSize = $row['cart_product_size'];
        $productQuantity = $row['cart_quantity'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vulcan - Shopping Cart</title>
</head>
<body>
<div class="cart-container">
    <?php include "header.php"?>
        <div class="container">
            <h1 class="title2">Your Cart <i class="fa-solid fa-cart-shopping"></i></h1>
            <div class="cart-table">
                <table>
                    <tr>
                        <th>Select</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $total = 0;
                        foreach ($query_result as $row) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='select[]'></td>";
                            echo "<td><img src='../products/{$row['product_image']}' alt='Product Image' width='200'></td>";
                            echo "<td>{$row['product_name']}</td>";
                            echo "<td>{$row['cart_product_size']}</td>";
                            echo "<td>{$row['cart_quantity']}</td>";
                            echo "<td>{$row['product_price']}</td>";
                            echo "<td><button>Delete</button></td>";
                            echo "</tr>";

                            $subtotal = $productPrice * $productQuantity;
                            $total += $subtotal;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include "check-out.php"?>
</body>
</html>