<?php
    include('conn.php');

    // Get the order ID from the GET parameters
    $orderID = isset($_GET['order_id']) ? $_GET['order_id'] : '';

    if (!empty($orderID)) {
        // Update the order status to 'Cancelled'
        $updateOrderQuery = "UPDATE tborders SET order_status = 'Cancelled' WHERE order_id = $orderID";
        $conn->query($updateOrderQuery);

        // Retrieve product details for the cancelled order
        $getProductQuery = "SELECT product_id, order_quantity FROM tborders WHERE order_id = $orderID";
        $productResult = $conn->query($getProductQuery);
        $productDetails = $productResult->fetch_assoc();

        // Return the ordered quantity to the product stock
        if ($productDetails) {
            $updateStockQuery = "UPDATE tbproducts SET product_stocks = product_stocks + {$productDetails['order_quantity']} WHERE product_id = {$productDetails['product_id']}";
            $conn->query($updateStockQuery);
        }

        echo "<script>alert('Order Cancelled');</script>";
    } else {
        echo "Invalid order ID";
    }
?>