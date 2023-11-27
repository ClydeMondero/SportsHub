<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
?>

<?php
     if(isset($_GET['id'])){
        $productID = $_GET['id'];
        $product_query = "select `product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added` from `tbproducts` where `product_id` = ".$productID;
        
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
    <title>Place Order</title>
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

            <form action="">
                <h2>Payment Method</h1>

                <div class="methods">
                    <div class="method">
                        <input type="radio" id="cod" name="payment">
                        <label for="cod"><i class="fa-solid fa-wallet"></i> Cash on Delivery</label>
                    </div>
                   
                    <div class="method">
                        <input type="radio" id="gcash" name="payment">
                        <img src="../assets/imgs/gcash.png" width="100px"><label for="gcash">G-Cash</label>
                    </div>    

                    <div class="method">
                        <input type="radio" id="card" name="payment">
                        <label for="card"><i class="fa-solid fa-credit-card"></i> Card</label>
                    </div>                    
                </div>

                <div class="line"></div>

                <h2>Your Address</h2>

                <div class="row2">
                    <label for="address">Street Address:</label>
                    <input type="text" name="address" id="address">
                </div>
                
                <div class="row2">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city">
                </div>

                <div class="row2">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country">
                </div>

                <input type="submit" value="Save" class="button">
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
                                </div>                                
                                <p class="product-quantity">1 pc</p>
                            </div>                            
                        </div>                       
                    </div>
                   
                    <div class="line"></div>

                    <div class="total">
                        <p>Total: </p>
                        <p>₱<?php echo $productPrice ?></p>
                    </div>
                </div>
                <?php
               echo '<a href = "./place-order.php?id='. $row["product_id"].'&quantity=1">';
               echo '<button class="order">Place Order</button></a>'; 
                    if(isset($_GET['quantity'])){
                        echo ("<script>alert('Purchase Successful');</script>");
                        $minus_query = "update tbproducts set product_stocks = product_stocks - ".$_GET['quantity']." where product_id = ". $_GET['id'];
                        $conn->query($minus_query);
                    }
                ?>
            </div>
        </div>

    </div>

    <?php include "./footer.php" ?>
</body>
</html>