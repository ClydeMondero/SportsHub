<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    include('conn.php');
?>

<?php 
    if(isset($_GET['id'])){
        $productID = $_GET['id'];
        $product_query = "select `product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added` from `tbproducts` where `product_id` = ".$productID;
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

                    echo '
                        <div>
                        <label for="txt-size">Size:</label>
                        <select name="txt-size" class="txt-size" id="clothing-sizes"  required>
                            <option value="X-Small">X-Small</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                            <option value="X-Large">X-Large</option>
                            <option value="XX-Large">XX-Large</option>
                        </select>
            
                        <select name="txt-size" class="txt-size" id="shoes-sizes" style="display:none;" required>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
            
                        <select name="txt-size" class="txt-size" id="acseqpmnt-sizes" style="display:none;" required>
                            <option value="N/A">N/A</option>
                        </select>
                        </div>
                        ';

                    echo '<div>';
                        echo '<p class="product-stock">Stock: <span>'.$stock.'</span></p>';
                        echo '<div class="buttons">';
                            echo '<button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>';
                            if(!$loggedIn){
                                echo '<button class="buy-btn" onClick = "handleClick()">Buy Now</button>';
                            }else{
                                echo '<button id="buy-now-btn" class="buy-btn">Buy Now</button>';
                            }
                        echo '</div>';
                    echo '</div>';

                echo '</div>'; 

            echo '</div>';
        ?>
    </div>        

    <?php include "footer.php" ?>
    <script>
       function handleClick(){
            alert("Please Login First.");
            window.location.href = "./login.php";
        }

        var category = "<?php echo strtolower($category); ?>";

        function changeSize() {
            var clothingSizes = document.getElementById("clothing-sizes");
            var shoesSizes = document.getElementById("shoes-sizes");
            var acseqpmntSizes = document.getElementById("acseqpmnt-sizes");

            if (category === "tops" || category === "bottoms" || category === "innerwears") {
                document.getElementById("clothing-sizes").style.display = "flex";
                document.getElementById("shoes-sizes").style.display = "none";
                document.getElementById("acseqpmnt-sizes").style.display = "none";
            } else if (category === "shoes") {
                document.getElementById("clothing-sizes").style.display = "none";
                document.getElementById("shoes-sizes").style.display = "flex";
                document.getElementById("acseqpmnt-sizes").style.display = "none";
            } else if (category === "accessories and equipment") {
                document.getElementById("clothing-sizes").style.display = "none";
                document.getElementById("shoes-sizes").style.display = "none";
                document.getElementById("acseqpmnt-sizes").style.display = "flex";
            }

            document.getElementById("buy-now-btn").addEventListener("click", function () {
                var selectedSize;
                
                if (category === "tops" || category === "bottoms" || category === "innerwears") {
                    selectedSize = document.getElementById("clothing-sizes").value;
                } else if (category === "shoes") {
                    selectedSize = document.getElementById("shoes-sizes").value;
                } else if (category === "accessories and equipment") {
                    selectedSize = document.getElementById("acseqpmnt-sizes").value;
                }
        
                window.location.href = "./place-order.php?id=<?php echo $row["product_id"]; ?>&size=" + encodeURIComponent(selectedSize);
            });

        }

        window.onload = changeSize;
    </script>
</body>
</html>