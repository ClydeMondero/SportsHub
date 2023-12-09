<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    // Calculate the order arrival date (7 days from the order date)
    $orderDate = date('Y-m-d H:i:s');
    $orderArrivalDate = date('Y-m-d H:i:s', strtotime($orderDate . ' + 7 days'));
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_SESSION['id'];
    
        // Array to store products exceeding stock
        $exceededStockProducts = array();
    
        // Check if the selected items exceed the available stock
        $selectedCartItems = isset($_POST['select']) && is_array($_POST['select']) ? $_POST['select'] : array();

        // Check if $selectedCartItems is not empty before using it in the IN clause
        $cartIdInClause = !empty($selectedCartItems) ? implode(',', $selectedCartItems) : 'NULL';

        $checkStockQuery = "SELECT SUM(c.cart_quantity) AS total_quantity, c.product_id, p.product_name
                    FROM tbcarts c
                    JOIN tbproducts p ON c.product_id = p.product_id
                    WHERE c.user_id = ? AND c.cart_id IN ($cartIdInClause)
                    GROUP BY c.product_id";
        $stmtStock = $conn->prepare($checkStockQuery);
        $stmtStock->bind_param("i", $userID);
        $stmtStock->execute();
        $stockResult = $stmtStock->get_result();
    
        while ($stockRow = $stockResult->fetch_assoc()) {
            $productID = $stockRow['product_id'];
            $productName = $stockRow['product_name'];
            $totalQuantity = $stockRow['total_quantity'];
        
            $getStockQuery = "SELECT product_stocks FROM tbproducts WHERE product_id = ?";
            $stmtGetStock = $conn->prepare($getStockQuery);
            $stmtGetStock->bind_param("i", $productID);
            $stmtGetStock->execute();
            $stockRow = $stmtGetStock->get_result()->fetch_assoc();
            $availableStock = $stockRow['product_stocks'];
        
            $stmtGetStock->close();
        
            if ($totalQuantity > $availableStock) {
                $exceededStockProducts[] = array('id' => $productID, 'name' => $productName);
            }
        }

        if (!empty($exceededStockProducts)) {
            $exceededProductsList = implode(', ', array_map(function($product) {
                return $product['name'];
            }, $exceededStockProducts));
            echo ("<script>alert('Quantity for products: $exceededProductsList exceeds available stock.');</script>");
            echo "<script>setTimeout(function() { window.location.href = 'cart.php'; }, 1000);</script>";
            exit();
        }
    
        $cartQuery = "SELECT c.product_id, c.cart_quantity, p.product_name, p.product_image, p.product_price, c.cart_product_size
              FROM tbcarts c
              JOIN tbproducts p ON c.product_id = p.product_id
              WHERE c.user_id = ?";

        if (!empty($selectedCartItems)) {
            $cartQuery .= " AND c.cart_id IN (" . implode(',', $selectedCartItems) . ")";
        }

        $stmt = $conn->prepare($cartQuery);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $cartResult = $stmt->get_result();
    
        $cartProducts = [];
        $totalSum = 0;
    
        while ($cartRow = $cartResult->fetch_assoc()) {
            $cartProducts[] = $cartRow;
            $subtotal = $cartRow['product_price'] * $cartRow['cart_quantity'];
            $totalSum += $subtotal;
        }
        $stmt->close();

        if (isset($_POST['street'], $_POST['barangay'], $_POST['municipality'], $_POST['city'])) {
            // Concatenate the address
            $orderAddress = $_POST['street'] . ', ' . $_POST['barangay'] . ', ' . $_POST['municipality'] . ', ' . $_POST['city'];
        
            
        
            // Insert into tborders table
            $insertOrderQuery = "INSERT INTO tborders (product_id, order_product_size, order_quantity, user_id, order_price, order_payment_method, order_address, order_date, order_arrival_date, order_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";

            $stmtInsertOrder = $conn->prepare($insertOrderQuery);
        
            foreach ($cartProducts as $cartProduct) {
                $productID = $cartProduct['product_id'];
                $orderProductSize = $cartProduct['cart_product_size'];
                $orderQuantity = $cartProduct['cart_quantity'];

                // Calculate the subtotal for each item
                $subtotal = $cartProduct['product_price'] * $orderQuantity;

                // Corrected bind_param types and replaced $subtotal
                $stmtInsertOrder->bind_param("issdsssss", $productID, $orderProductSize, $orderQuantity, $userID, $subtotal, $_POST['payment'], $orderAddress, $orderDate, $orderArrivalDate);
                $stmtInsertOrder->execute();
            }
        
            // Close the $stmtInsertOrder
            $stmtInsertOrder->close();
        
            // Delete ordered items from tbcarts table
            $deleteCartItemsQuery = "DELETE FROM tbcarts WHERE user_id = ?";

            if (!empty($selectedCartItems)) {
                $deleteCartItemsQuery .= " AND cart_id IN (" . implode(',', $selectedCartItems) . ")";
            }

            $stmtDeleteCartItems = $conn->prepare($deleteCartItemsQuery);
            $stmtDeleteCartItems->bind_param("i", $userID);
            $stmtDeleteCartItems->execute();
            $stmtDeleteCartItems->close();
        
            // Create an array to store the total quantity for each product ID
            $totalQuantities = array();

            // Calculate the total quantity for each product ID
            foreach ($cartProducts as $cartProduct) {
                $productID = $cartProduct['product_id'];
                $orderQuantity = $cartProduct['cart_quantity'];
            
                // Add the quantity to the total for the respective product ID
                if (!isset($totalQuantities[$productID])) {
                    $totalQuantities[$productID] = $orderQuantity;
                } else {
                    $totalQuantities[$productID] += $orderQuantity;
                }
            }

            // Update the stock for each product ID
            foreach ($totalQuantities as $productID => $totalQuantity) {
                // Update the stock in tbproducts table
                $updateStockQuery = "UPDATE tbproducts
                                     SET product_stocks = product_stocks - ?
                                     WHERE product_id = ?";

                $stmtUpdateStock = $conn->prepare($updateStockQuery);
                $stmtUpdateStock->bind_param("ii", $totalQuantity, $productID);
                $stmtUpdateStock->execute();
                $stmtUpdateStock->close();
            }

            
            if($_POST['payment'] == 'COD') {
                echo "<script>
                        setTimeout(function() { 
                            window.open('cash-on-delivery.php?totalsum=$totalSum', '_blank'); 
                            window.location.href = 'cart.php';
                        }, 400);
                        </script>";
            } elseif($_POST['payment'] == 'GCash') {
                echo "<script>
                        setTimeout(function() { 
                            window.open('gcash.php?totalsum=$totalSum', '_blank'); 
                            window.location.href = 'cart.php';
                        }, 400);
                        </script>";
            } elseif($_POST['payment'] == 'Card') {
                echo "<script>
                        setTimeout(function() { 
                            window.open('card-payment.php?totalsum=$totalSum', '_blank'); 
                            window.location.href = 'cart.php';
                        }, 400);
                        </script>";
            }
            exit();
         }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/cart-checkout.css">   
    <title>Vulcan - Cart Check Out Page</title>

</head>
<body>
    <?php include "./header.php" ?>

    <div class="container">
        <div class="payment-method">
            <div class="back">
                <a href="cart.php" >
                    <i class="fa-solid fa-chevron-left"></i>     
                    <span>Back</span>
                </a>
            </div>

            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
                <h2>Payment Method</h1>

                <div class="methods">
                    <div class="method">
                        <input type="radio" id="cod" name="payment" value="COD" required checked>
                        <label for="cod"><i class="fa-solid fa-wallet"></i> Cash on Delivery</label>
                    </div>
                   
                    <div class="method">
                        <input type="radio" id="gcash" name="payment" value="GCash" required>
                        <img src="../assets/imgs/gcash.png" width="100px"><label for="gcash">G-Cash</label>
                    </div>    

                    <div class="method">
                        <input type="radio" id="card" name="payment" value="Card" required>
                        <label for="card"><i class="fa-solid fa-credit-card"></i> Card</label>
                    </div>                    
                </div>

                <div class="line"></div>

                <h2>Your Address</h2>

                <div class="row2">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street">
                </div>
                
                <div class="row2">
                    <label for="barangay">Barangay:</label>
                    <input type="text" name="barangay" id="barangay">
                </div>

                <div class="row2">
                    <label for="municipality">Municipality:</label>
                    <input type="text" name="municipality" id="municipality">
                </div>

                <div class="row2">
                    <label for="city">City/Province:</label>
                    <input type="text" name="city" id="city">
                </div>

                <div class="arrival-date">
                    <h2>Expected Arrival Date</h2>
                    <p><?php echo date('F j, Y', strtotime($orderArrivalDate)); ?></p>
                </div>

                <input type="submit" class="order" value="Place Order">
            </form>
        </div>

        <div class="check-out">
            <div class="black">
                <div class="cream">
                    <div class="cart-products">                            
                            <div class="top">
                                <h1>Cart Items</h1>
                                <div class="total">
                                <p>Total: </p>
                                <p id="totalPrice">₱<?php echo number_format($totalSum, 2); ?></p>
                                </div>                                
                            </div>
                            <?php foreach ($cartProducts as $cartProduct): ?>
                                <div class="cart-product">
                                    <img src="../products/<?php echo $cartProduct['product_image']; ?>" alt="<?php echo $cartProduct['product_name']; ?>" width="200px">
                                    <div class="product-details">
                                        <h2 class="product-name"><?php echo $cartProduct['product_name']; ?></h3>
                                        <p class="product-size">Size: <?php echo $cartProduct['cart_product_size']; ?></p>
                                        <p class="product-price">Price: ₱<?php echo number_format($cartProduct['product_price'], 2); ?></p>
                                        <p class="product-quantity">Quantity: <?php echo $cartProduct['cart_quantity']; ?> pc</p>
                                        <p class="product-subtotal">Subtotal: ₱<?php echo number_format($cartProduct['product_price'] * $cartProduct['cart_quantity'], 2); ?></p>                                       
                                    </div>                                  
                                </div>
                                <hr>    
                            <?php endforeach; ?>                                                                                    
                        </div>
                    </div>                    
                </div> 
            </div>
        </div>
    </div>
    <?php include "./footer.php" ?>
</body>
</html>