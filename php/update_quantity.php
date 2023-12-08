<?php
    include('conn.php');
    session_start();

    if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
        $productId = $_GET['product_id'];
        $quantity = $_GET['quantity'];

        $updateQuery = "UPDATE tbcarts SET cart_quantity = $quantity WHERE user_id = {$_SESSION['id']} AND product_id = $productId";
        $conn->query($updateQuery);

    }
?>