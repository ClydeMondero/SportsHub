<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
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
            <h1 class="title">Your Cart <i class="fa-solid fa-cart-shopping"></i></h1>
            <div class="cart-table">
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><img src="" alt=""></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>