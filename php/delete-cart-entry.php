<?php
include('conn.php');

if (isset($_GET['cart_id'])) {
    $cartId = $_GET['cart_id'];
    $deleteQuery = "DELETE FROM tbcarts WHERE cart_id = $cartId";
    $conn->query($deleteQuery);
}
?>