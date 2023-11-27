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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/landing-page.css">    
    <title>VULCAN</title>
</head>
<body>   
    <?php include("header.php") ?>         
    
        <!-- Latest -->
    <div class="trending content">
        <div class="trending-title">
            <span>Latest</span>            
        </div>
        <div class="trending-image">
            <img src="..\assets\imgs\latest.jpg" alt="Nike Trending">
        </div>
        <div class="trending-details">
            <p class="trending-caption">Speed Beyond Your Wildest Dreams</p>
            <p class="description">Make it real with Mercurial Dream Speed 7.
            </p>
            <a href="shopping-page.php"><button>Shop Now</button></a>
        </div>
    </div>


    <!--Product Details-->
    <div class="popular-products content">
        <div class="product-title">
            <span>Popular Products</span>            
        </div>
        <div class="products-container">
                <img src="../assets/imgs/ball.jpg"class="product" alt="">
                <img src="../assets/imgs/bag.jpg" class="product" alt="">
                <img src="../assets/imgs/shoes.jpg" class="product" alt="">
                <img src="../assets/imgs/short.jpg" class="product" alt="">
                <img src="..\assets\imgs\sweater.jpg" class="product" alt="">
        </div>
    </div>

    <!-- Event -->
    <div class="event content">
        <div class="event-title">
            <h1>Christmas Sale is Coming!</h1>
            <p class="event-sub-text">The best gifts is keep giving</p>
        </div>
        <div class="event-container">
            <img src="../assets/imgs/sale1.jpg" class="event-promo" alt="">
            <img src="../assets/imgs/sale3.jpg" class="event-promo" alt="">
            <img src="..\assets\imgs\sale2.jpg" class="event-promo" alt="">
        </div>
    </div>

    <!-- Trending -->
    <div class="trending content">
        <div class="trending-title">
            <span>Trending</span>            
        </div>
        <div class="trending-image">
            <img src="..\assets\imgs\poster-img.jpg" alt="Nike Trending">
        </div>
        <div class="trending-details">
            <p class="trending-caption">Nike Men's Downshifter 12 Shoes</p>
            <p class="description">Made from at least 20% recycled content by weight, 
                it has a supportive fit and stable ride, with a lightweight feel that easily transitions from your workout to hangout.
            </p>
            <a href="shopping-page.php"><button>Shop Now</button></a>
        </div>
    </div>

    <!-- Services -->
    <div class="services content">
        <div class="services-title">
            <span>Services</span>            
        </div>

        <div class="services-details">
            <div class="service">
                <i class="fa-solid fa-truck-fast" style="color: #000000;"></i>
                <h1>Online Shopping and Delivery</h1>
                <p>Allowing customers to browse and purchase products from the comfort of their homes. </p>
            </div>
            <div class="service">
                <i class="fa-solid fa-comments" style="color: #000000;"></i>
                <h1>Expert Advice and Consultation</h1>
                <p>Knowledgeable staff can provide advice and recommendations on the right equipment.</p>
            </div>
            <div class="service">
                <i class="fa-regular fa-money-bill-1" style="color: #000000;"></i>
                <h1>Equipment Sales</h1>
                <p>This includes items such as sports apparel, footwear, sports gear, and accessories.</p>
            </div>
        </div>
    </div>

    <!--Contact Us -->
    <div class="contacts content">
        <div class="contact-title">
            <span>Contact Us</span>
            <p class="contact-description">Your satisfaction is our mission, and we're here to make your online experience extraordinary.</p>
        </div>
        <div class="soc-meds">
            <i class="fa-brands fa-square-x-twitter" style="color: #000000;"></i>
            <i class="fa-brands fa-square-facebook" style="color: #000000;"></i>
            <i class="fa-brands fa-square-instagram" style="color: #000000;"></i>
        </div>
    </div>
    <?php include ("footer.php"); ?>    
</body>
</html>