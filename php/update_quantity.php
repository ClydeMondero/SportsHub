<?php
    include('conn.php');
    session_start();

    if (isset($_GET['cart_id']) && isset($_GET['quantity'])) {
        $cartId = $_GET['cart_id'];
        $quantity = $_GET['quantity'];
    
        $updateQuery = "UPDATE tbcarts SET cart_quantity = $quantity WHERE user_id = {$_SESSION['id']} AND cart_id = $cartId";
        $conn->query($updateQuery);
    }
?>