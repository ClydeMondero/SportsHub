<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);    
    include('conn.php');
?>

<?php 
    if(isset($_GET['id'])){
        $productID = $_GET['id'];
        $product_query = "select `product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added` from `tbproducts` where `product_id` = ".$productID;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/product-page.css">   
    <title>Vulcan - Product Page</title>
</head>
<body>
    <?php include "header.php" ?>
    
    <div class="product-container">
        <div class="back">
            <a href="./shopping-page.php">
                <i class="fa-solid fa-chevron-left"></i>                     
                <span>Back</span>
            </a>
        </div>        
        <?php
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
            echo '<div class ="product">';
                echo '<img src="../products/' . $image . '" alt="' . $row['product_name'] . '">';
                echo '<div class="product-details">';

                    echo '<div>';
                        echo '<p class="product-name">'.$name.'</p>';
                        echo '<p class="product-price">₱'.$price.'</p>';
                    echo '</div>';
            
                    echo '<div>';
                        echo '<p class="product-description">'.$desc.'</p>';
                        echo '<div class="product-tags">';
                            echo '<p>'.$category.'</p>';
                            echo '<p>'.$brand.'</p>';
                            echo '<p>'.$sport.'</p>';
                    echo '</div>';

                    echo '<civ>';
                        echo '<p class="product-stock">Stock: <span>'.$stock.'</span></p>';
                        echo '<div class="buttons">';
                            echo '<button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>';
                            echo '<button class="buy-btn">Buy Now</button>';
                        echo '</div>';
                    echo '</div>';

                echo '</div>'; 

            echo '</div>';
        ?>
    </div>        

    <?php include "footer.php" ?>
</body>
</html>


<!--<div class="product">                        
            <img src="../products\65641e8ce04fb.png" alt="">

            <div class="product-details">
                <div>
                    <p class="product-name">Nike</p>
                    <p class="product-price">₱6, 195</p>
                </div>                
                <div>
                    <p class="product-description">
                        The radiance lives on in the Nike Air Force 1 '07, 
                        the b-ball icon that puts a fresh spin on what you know best: 
                        leather, bold colours and the perfect amount of flash to make you shine.
                    </p>
                    <div class="product-tags">                    
                        <p>Shoes</p>
                        <p>Nike</p>
                        <p>Casual</p>
                    </div>  
                </div>
                 
                <div>
                    <p class="product-stock">Stock: <span>50</span></p>
                    <div class="buttons">
                        <button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                        <button class="buy-btn">Buy Now</button>
                    </div>
                </div>             
            </div>            
        </div>-->