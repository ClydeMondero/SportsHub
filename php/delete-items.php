<?php
session_start();
include('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted
    if (isset($_POST['product_ids']) && is_array($_POST['product_ids'])) {
        
        // Check if the 'product_ids' array is set and is an array
        $selectedProductIds = $_POST['product_ids'];

        //selected product IDs
        $productsToDelete = implode(',', $selectedProductIds);
        $deleteQuery = "update `tbproducts` set `product_stocks`= 0 where `product_id` in (".$productsToDelete.")";
        $conn->query($deleteQuery);
        mysqli_close($conn);
        echo ("<script>alert('Product/s Deleted');</script>");
        header('location: add-items.php');
    } else {
        echo ("<script>alert('No Products Selected');</script>");
    }
} 
?>

