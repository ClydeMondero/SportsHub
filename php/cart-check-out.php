<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select'])) {
        $selectedCartItems = $_POST['select'];
        $userID = $_SESSION['id'];
    
        // Array to store products exceeding stock
        $exceededStockProducts = array();
    
        // Check if the selected items exceed the available stock
        $checkStockQuery = "SELECT SUM(c.cart_quantity) AS total_quantity, c.product_id, p.product_name
                            FROM tbcarts c
                            JOIN tbproducts p ON c.product_id = p.product_id
                            WHERE c.user_id = ? AND c.cart_id IN (" . implode(',', $selectedCartItems) . ")
                            GROUP BY c.product_id";
        $stmtStock = $conn->prepare($checkStockQuery);
        $stmtStock->bind_param("i", $userID);
        $stmtStock->execute();
        $stockResult = $stmtStock->get_result();
    
        while ($stockRow = $stockResult->fetch_assoc()) {
            $productID = $stockRow['product_id'];
            $productName = $stockRow['product_name'];
            $totalQuantity = $stockRow['total_quantity'];
        
            // Retrieve the available stock for the product
            $getStockQuery = "SELECT product_stocks FROM tbproducts WHERE product_id = ?";
            $stmtGetStock = $conn->prepare($getStockQuery);
            $stmtGetStock->bind_param("i", $productID);
            $stmtGetStock->execute();
            $stockRow = $stmtGetStock->get_result()->fetch_assoc();
            $availableStock = $stockRow['product_stocks'];
        
            $stmtGetStock->close();
        
            // Check if the total quantity exceeds the available stock
            if ($totalQuantity > $availableStock) {
                // Add product to the list
                $exceededStockProducts[] = array('id' => $productID, 'name' => $productName);
            }
        }

        // Check if there are products exceeding stock and display a message
        if (!empty($exceededStockProducts)) {
            $exceededProductsList = implode(', ', array_map(function($product) {
                return $product['name'];
            }, $exceededStockProducts));
            echo ("<script>alert('Quantity for products: $exceededProductsList exceeds available stock.');</script>");
            echo "<script>setTimeout(function() { window.location.href = 'cart.php'; }, 1000);</script>";
            exit();
        }
      
    
        // If the stock check is successful, proceed with fetching cart items
        $cartQuery = "SELECT c.product_id, c.cart_quantity, p.product_name, p.product_image, p.product_price, c.cart_product_size
                      FROM tbcarts c
                      JOIN tbproducts p ON c.product_id = p.product_id
                      WHERE c.user_id = ? AND c.cart_id IN (" . implode(',', $selectedCartItems) . ")";
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
    }else{
        echo ("<script>alert('No Selected Products');</script>");
        echo "<script>setTimeout(function() { window.location.href = 'cart.php'; }, 1000);</script>";
        exit();
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
    <link rel="stylesheet" href="../styles/place-order.css">   
    <title>Vulcan - Place Order Page</title>

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

                <input type="submit" class="order" value="Place Order">
            </form>
        </div>

        <div class="check-out">
            <div class="black">
                <div class="cream">
                <div class="cart-products">
                        <h2>Cart Items</h2>
                        <?php foreach ($cartProducts as $cartProduct): ?>
                            <div class="cart-item">
                                <img src="../products/<?php echo $cartProduct['product_image']; ?>" alt="<?php echo $cartProduct['product_name']; ?>" width="200px">
                                <div class="product-details">
                                    <h3 class="product-name"><?php echo $cartProduct['product_name']; ?></h3>
                                    <h3 class="product-name">Size:<?php echo $cartProduct['cart_product_size']; ?></h3>
                                    <p class="product-price">Price: ₱<?php echo number_format($cartProduct['product_price'], 2); ?></p>
                                    <p class="product-quantity">Quantity: <?php echo $cartProduct['cart_quantity']; ?> pc</p>
                                    <p class="product-price">Subtotal: ₱<?php echo number_format($cartProduct['product_price'] * $cartProduct['cart_quantity'], 2); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="total">
                            <p>Total: </p>
                            <p id="totalPrice">₱<?php echo number_format($totalSum, 2); ?></p>
                        </div>
                    </div>
                    </div>
                    <div class="line"></div>
                </div> 
            </div>
        </div>
    </div>
    <?php include "./footer.php" ?>
</body>
</html>