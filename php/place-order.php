<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);

     if(isset($_GET['id'])){
        $userID = $_SESSION['id'];
        $productID = $_GET['id'];
        $product_query = "select `product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added` from `tbproducts` where `product_id` = ".$productID;
        
        $query_result = $conn->query($product_query);
        foreach($query_result as $row){
            $image = $row["product_image"];
            $name = $row["product_name"];
            $category = $row["product_category"];
            $sport = $row["product_sport"];
            $price = $row["product_price"];
            $desc = $row["product_description"];
            $brand = $row["product_brand"];
            $stock = $row["product_stocks"];
        }
        
        $GLOBALS['productName'] = $name;
        $GLOBALS['productImage'] = $image;
        $GLOBALS['productPrice'] = $price;
        $GLOBALS['productStocks'] = $stock;
    }

    if(isset($_GET['size'])){
        $productSize = $_GET['size'];
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


    <script>
        function updateTotal() {
            // Get the selected quantity
            var quantityInput = document.getElementById('quantity');
            var quantity = parseInt(quantityInput.value);

            // Check if the entered quantity exceeds the available stock
            if (quantity > <?php echo $productStocks; ?>) {
                // If so, set the quantity to the available stock
                quantity = <?php echo $productStocks; ?>;
                quantityInput.value = quantity;
            }

            // Update the displayed quantity
            document.getElementById('displayedQuantity').innerText = quantity + " pc";

            // Calculate and update the total price
            var totalPrice = quantity * <?php echo $productPrice; ?>;
            document.getElementById('totalPrice').innerText = "₱" + totalPrice.toFixed(2);
        }
    </script>

</head>
<body>
    <?php include "./header.php" ?>

    <div class="container">
        <div class="payment-method">
            <div class="back">
                <a href="./shopping-page.php">
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

                <div class="row2">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" oninput="updateTotal()" max="<?php echo $productStocks; ?>">
                </div>

                <h2>Your Address</h2>

                <div class="row2">
                    <label for="address">Street:</label>
                    <input type="text" name="street" id="street">
                </div>
                
                <div class="row2">
                    <label for="city">Barangay:</label>
                    <input type="text" name="barangay" id="barangay">
                </div>

                <div class="row2">
                    <label for="municipality">Municipality:</label>
                    <input type="text" name="municipality" id="municipality">
                </div>

                <div class="row2">
                    <label for="country">City/Province:</label>
                    <input type="text" name="city" id="city">
                </div>

                <input type="submit" class="order" value="Place Order">
            </form>
        </div>

        <div class="check-out">
            <div class="black">
                <div class="cream">
                    <div class="products">
                        <div class="product">
                            <?php echo '<img src="../products/' . $image . '" alt="' . $row['product_name'] . '">';?>
                            <div class="product-details">
                                <div>
                                    <h3 class="product-name"><?php echo $productName ?></h3>
                                    <p class="product-price">₱<?php echo $productPrice ?></p>
                                    <p class="product-price">Size: <?php echo $productSize ?></p>
                                </div>                                
                                <div class="product-quantity" id="displayedQuantity">1 pc</div>

                            </div>                            
                        </div>                       
                    </div>
                   
                    <div class="line"></div>

                    <div class="total">
                        <p>Total: </p>
                        <p id="totalPrice">₱<?php echo $productPrice; ?></p>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productID = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $paymentMethod = $_POST['payment'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $municipality = $_POST['municipality'];
            $city = $_POST['city'];
            $address = $street . ', ' . $barangay . ', ' . $municipality . ', ' . $city;
            $checkStockQuery = "SELECT `product_stocks` FROM `tbproducts` WHERE `product_id` = $productID";
            $stockResult = $conn->query($checkStockQuery);
            $totalPrice = $productPrice * $quantity;

            if ($stockResult->num_rows > 0) {
                $row = $stockResult->fetch_assoc();
                $currentStocks = $row['product_stocks'];
                if ($quantity <= $currentStocks) {
                    $newStocks = $currentStocks - $quantity;
                    $updateStockQuery = "UPDATE `tbproducts` SET `product_stocks`='$newStocks' WHERE `product_id`='$productID'";
                    $conn->query($updateStockQuery);
                    $orderDate = date('Y-m-d H:i:s');
                    $orderArrivalDate = date('Y-m-d', strtotime($orderDate . ' + 7 days'));
                    $orderInsertQuery = "INSERT INTO `tborders` 
                    (`product_id`, `order_product_size`, `order_quantity`, `user_id`, 
                    `order_price`, `order_payment_method`, `order_address`, `order_date`, 
                    `order_arrival_date`, `order_status`)
                    VALUES 
                    ('$productID', '$productSize', '$quantity', '$userID', 
                    '$totalPrice', '$paymentMethod', '$address', '$orderDate', '$orderArrivalDate', 'Pending')";

                    $conn->query($orderInsertQuery);
                    echo "<script>alert('Order Placed');</script>";
                    echo "<script>setTimeout(function() { window.location.href = 'shopping-page.php'; }, 1000);</script>";
                    exit();
                } else {
                    echo "<script>alert('Not enough stock available.');</script>";
                }
            } else {
                echo "<script>alert('Product not found.');</script>";
            }
        }
    ?>


    <?php include "./footer.php" ?>
</body>
</html>