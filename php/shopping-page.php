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
    <link rel="stylesheet" href="../styles/shopping-page.css">
    <title>Shopping Page</title>
</head>
<body>       
    <?php include("header.php") ?>

    <div class="container">
        <div class="categories">
            <a href="shopping-page.php?page=shoes">Shoes</a>            
            <a href="shopping-page.php?page=topsandtees">Tops & T-Shirts</a>
            <a href="shopping-page.php?page=shortsandpants">Shorts & Pants</a>
            <a href="shopping-page.php?page=innerwears">Inner Wears</a>
            <a href="shopping-page.php?page=acsandeqpmnt">Accessories & Equipment</a>
        </div> 
            
        <div class="products">
            <?php                   
                if(isset($_GET["page"])){
                switch($_GET["page"]){
                    case "shoes":
                        include_once "./categories/shoes.php";
                        break;
                    case "topsandtees":
                        include_once "./categories/tops&tshirts.php";
                        break;
                    case "shortsandpants":
                        include_once "./categories/shorts&pants.php";
                        break;
                    case "innerwears":
                        include_once "./categories/innerwears.php";
                        break;
                    case "acsandqpmnt":
                        include_once "./categories/accessories&equipment.php";
                        break;                
                }
                }else{
                    include_once "./categories/shoes.php";  
                }
            ?> 
        </div>                                      
    </div>
    
    <?php include "footer.php"  ?>     
</body>
</html>