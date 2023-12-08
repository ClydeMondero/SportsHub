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
                <ul class="pages">
                    <li id="shoes"><a href="shopping-page.php?page=shoes&type=categories" >Shoes</a></li>           
                    <li id="topsandtees"><a href="shopping-page.php?page=topsandtees&type=categories">Tops & T-Shirts</a></li>
                    <li id="innerwears"><a href="shopping-page.php?page=innerwears&type=categories" >Inner Wears</a></li>
                    <li id="shortsandpants"><a href="shopping-page.php?page=shortsandpants&type=categories">Shorts & Pants</a></li>
                    <li id="acsandeqpmnt"><a href="shopping-page.php?page=acsandeqpmnt&type=categories">Accessories & Equipment</a></li>
                </ul>
            </div>            

            <div class="dropdown sports-dropdown">
                <h1 onclick="toggleDropdown('sports')">Sports
                &#9662;</h1>                            
                <ul class="pages">
                    <li id="general"><a href="shopping-page.php?page=general&type=sports" >General</a></li>  
                    <li id="football"><a href="shopping-page.php?page=football&type=sports" >Football</a></li>
                    <li id="basketball"><a href="shopping-page.php?page=basketball&type=sports" >Basketball</a></li>
                    <li id="running"><a href="shopping-page.php?page=running&type=sports" >Track and Field</a></li>
                    <li id="baseball"><a href="shopping-page.php?page=baseball&type=sports" >Baseball</a></li>  
                    <li id="volleyball"><a href="shopping-page.php?page=volleyball&type=sports" >Volleyball</a></li>
                    <li id="swimming"><a href="shopping-page.php?page=swimming&type=sports" >Swimming</a></li>
                    <li id="badminton"><a href="shopping-page.php?page=badminton&type=sports" >Badminton</a></li>
                    <li id="tennis"><a href="shopping-page.php?page=tennis&type=sports" >Tennis</a></li>
                </ul>
            </div>

            <div class="dropdown brands-dropdown">
                <h1 onclick="toggleDropdown('brands')">Brands
                &#9662;</h1>
                <ul class="pages">
                    <li id="nike"><a href="shopping-page.php?page=nike&type=brands">Nike</a></li>
                    <li id="adidas"><a href="shopping-page.php?page=adidas&type=brands">Adidas</a></li>
                    <li id="puma"><a href="shopping-page.php?page=puma&type=brands">Puma</a></li>
                    <li id="asics"><a href="shopping-page.php?page=asics&type=brands">Asics</a></li>
                    <li id="speed"><a href="shopping-page.php?page=speedo&type=brands">Speedo</a></li>
                    <li id="yonex"><a href="shopping-page.php?page=yonex&type=brands">Yonex</a></li>
                    <li id="molten"><a href="shopping-page.php?page=molten&type=brands">Molten</a></li>
                    <li id="mikasa"><a href="shopping-page.php?page=mikasa&type=brands">Mikasa</a></li>
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
                        default:
                            include_once "./categories/shoes.php";                        
                            break;                
                    }
                }
            ?>
        </div>
    </div>                       



    <script>        
        function toggleDropdown(dropdownType) {
            var dropdown = document.querySelector('.' + dropdownType + '-dropdown .pages');       
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';        
        }    
        
        function toggleSelect(page){
            let selected = document.querySelector('#' + page + ' a');
            selected.style.color = "#ce5a67";
        }        
    </script>

    <?php 
        if(isset($_GET["page"])){
            switch($_GET["page"]){                
                case "shoes":
                    echo "<script>toggleSelect('shoes')</script>";                        
                    break;
                case "topsandtees":
                    echo "<script>toggleSelect('topsandtees')</script>";
                    break;
                case "shortsandpants":
                    echo "<script>toggleSelect('shortsandpants')</script>";
                    break;
                case "innerwears":
                    echo "<script>toggleSelect('innerwears')</script>";
                    break;
                case "acsandeqpmnt":
                    echo "<script>toggleSelect('acsandeqpmnt')</script>";
                    break;
                //Dropdown Sports    
                case "general":
                    echo "<script>toggleSelect('general')</script>";
                    break;
                case "football":
                    echo "<script>toggleSelect('football')</script>";
                    break;
                case "basketball":
                    echo "<script>toggleSelect('basketball')</script>";
                    break;
                case "running":
                    echo "<script>toggleSelect('running')</script>";
                    break;
                case "baseball":
                    echo "<script>toggleSelect('baseball')</script>";
                    break;
                case "swimming":
                    echo "<script>toggleSelect('swimming')</script>";
                    break;
                case "volleyball":
                    echo "<script>toggleSelect('volleyball')</script>";
                    break;
                case "badminton":
                    echo "<script>toggleSelect('badminton')</script>";
                    break;
                case "tennis":
                    echo "<script>toggleSelect('tennis')</script>";
                    break;
                //Dropdown Brands
                case "nike":
                    echo "<script>toggleSelect('nike')</script>";
                    break;
                case "adidas":
                    echo "<script>toggleSelect('adidas')</script>";
                    break;
                case "puma":
                    echo "<script>toggleSelect('puma')</script>";
                    break;
                case "asics":
                    echo "<script>toggleSelect('asics')</script>";
                    break;
                case "speedo":
                    echo "<script>toggleSelect('speedo')</script>";
                    break;
                case "yonex":
                    echo "<script>toggleSelect('yonex')</script>";
                    break; 
                case "molten":
                    echo "<script>toggleSelect('molten')</script>";
                    break;
                case "mikasa":
                    echo "<script>toggleSelect('mikasa')</script>";
                    break; 
            }           
        }
        if(isset($_GET["type"])){
            switch($_GET["type"]){
                case "categories":
                    echo "<script>toggleDropdown('categories')</script>";
                    break;                
                case "sports":
                    echo "<script>toggleDropdown('sports')</script>";
                    break;
                case "brands":
                    echo "<script>toggleDropdown('brands')</script>";
                    break;
            }           
        }
    ?> 

    <?php include "footer.php"?>     
</body>
</html>