<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
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
    <title>Product</title>
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

        <div class="product">
            <img src="../products\65641e8ce04fb.png" alt="">

            <div class="product-details">
                <div>
                    <p class="product-name">Nike Air Force 1</p>
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
        </div>
    </div>          

    <?php include "footer.php" ?>
</body>
</html>
