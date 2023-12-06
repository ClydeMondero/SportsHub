<?php
    include("conn.php");
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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/shopping-page.css">
    <title>Vulcan - Shopping Page</title>
</head>
<body>       
    <?php include("header.php") ?>

    <div class="container">
        <div class="column-category">
            <div class=" dropdown categories-dropdown">
                <h1 onclick="toggleDropdown('categories')">Category
                &#9662;</h1>
                <ul class="pages selected">
                    <li><a href="shopping-page.php?page=shoes" >Shoes</a></li>           
                    <li><a href="shopping-page.php?page=topsandtees">Tops & T-Shirts</a></li>
                    <li><a href="shopping-page.php?page=shortsandpants">Shorts & Pants</a></li>
                    <li><a href="shopping-page.php?page=innerwears" >Inner Wears</a></li>
                    <li><a href="shopping-page.php?page=acsandeqpmnt">Accessories & Equipment</a></li>
                </ul>
            </div>

            <div class="dropdown sports-dropdown">
                <h1 onclick="toggleDropdown('sports')">Sports
                &#9662;</h1>
                <ul class="pages">
                    <li><a href="shopping-page.php?page=general" >General</a></li>  
                    <li><a href="shopping-page.php?page=football" >Football</a></li>
                    <li><a href="shopping-page.php?page=basketball" >Basketball</a></li>
                    <li><a href="shopping-page.php?page=running" >Track and Field</a></li>
                    <li><a href="shopping-page.php?page=baseball" >Baseball</a></li>  
                    <li><a href="shopping-page.php?page=volleyball" >Volleyball</a></li>
                    <li><a href="shopping-page.php?page=swimming" >Swimming</a></li>
                    <li><a href="shopping-page.php?page=badminton" >Badminton</a></li>
                    <li><a href="shopping-page.php?page=tennis" >Tennis</a></li>
                </ul>
            </div>

            <div class="dropdown brands-dropdown">
                <h1 onclick="toggleDropdown('brands')">Brands
                &#9662;</h1>
                <ul class="pages">
                    <li><a href="shopping-page.php?page=nike">Nike</a></li>
                    <li><a href="shopping-page.php?page=adidas">Adidas</a></li>
                    <li><a href="shopping-page.php?page=puma">Puma</a></li>
                    <li><a href="shopping-page.php?page=asics">Asics</a></li>
                    <li><a href="shopping-page.php?page=speedo">Speedo</a></li>
                    <li><a href="shopping-page.php?page=yonex">Yonex</a></li>
                    <li><a href="shopping-page.php?page=molten">Molten</a></li>
                    <li><a href="shopping-page.php?page=mikasa">Mikasa</a></li>
                </ul>
            </div>
        </div>
    
        <div class="products">
            <?php                   
                if(isset($_GET["page"])){
                switch($_GET["page"]){
                    //Dropdown Category
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
                    case "acsandeqpmnt":
                        include_once "./categories/accessories&equipment.php";
                        break;
                    //Dropdown Sports    
                    case "general":
                        include_once "./sports/general.php";
                        break;
                    case "football":
                        include_once "./sports/football.php";
                        break;
                    case "basketball":
                        include_once "./sports/basketball.php";
                        break;
                    case "running":
                        include_once "./sports/track and field.php";
                        break;
                    case "baseball":
                        include_once "./sports/baseball.php";
                        break;
                    case "swimming":
                        include_once "./sports/swimming.php";
                        break;
                    case "volleyball":
                        include_once "./sports/volleyball.php";
                        break;
                    case "badminton":
                        include_once "./sports/badminton.php";
                        break;
                    case "tennis":
                        include_once "./sports/tennis.php";
                        break;
                    //Dropdown Brands
                    case "nike":
                        include_once "./brands/nike.php";
                        break;
                    case "adidas":
                        include_once "./brands/adidas.php";
                        break;
                    case "puma":
                        include_once "./brands/puma.php";
                        break;
                    case "asics":
                        include_once "./brands/asics.php";
                        break;
                    case "speedo":
                        include_once "./brands/speedo.php";
                        break;
                    case "yonex":
                        include_once "./brands/yonex.php";
                        break; 
                    case "molten":
                        include_once "./brands/molten.php";
                        break;
                    case "mikasa":
                        include_once "./brands/mikasa.php";
                        break;                
                }
                }else{
                    include_once "./categories/shoes.php";                      
                }
            ?>
        </div>
    </div>

    <script>
        function toggleDropdown(dropdownType) {
            var dropdown = document.querySelector('.' + dropdownType + '-dropdown .pages');       
            dropdown.style.display = (dropdown.style.display === 'block' || dropdown.style.display=== '') ? 'none' : 'block';        
        }           
    </script>
    <?php include "footer.php"?>     
</body>
</html>