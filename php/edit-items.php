
<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    //Retrieve From Database Based on the passed ID
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
        $product_query = "select `product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added` from `tbproducts` where `product_id` = " . $productID;
        $result = $conn->query($product_query);
        
    //Set the values from the database to string to set it in the fields
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row['product_name'];
            $productDescription = $row['product_description'];
            $productCategory = $row['product_category'];
            $productSport = $row['product_sport'];
            $productSize = $row['product_size'];
            $productStocks = $row['product_stocks'];
            $productImage = $row['product_image'];
            $productBrand = $row['product_brand'];
            $productPrice = $row['product_price'];
            $dateAdded = $row['date_added'];
        }
    //Get the values from the form
        if(isset($_POST['btnEdit'])){
            $product_name = $_POST['txt-product-name'];
            $product_brand = $_POST['txt-brand'];
            $product_size = $_POST['txt-size'];
            $product_category = $_POST['txt-category'];
            $product_quantity = $_POST['txt-quantity'];
            $product_price = $_POST['txt-price'];
            $product_sport = $_POST['txt-sports'];
            $product_description = $_POST['txt-product-description'];
            //Check for duplicate
            $product_duplicate = false;
            $check_name_query = "select `product_name` from `tbproducts` where `product_name` not like '".$productName."'";
            $check_result = $conn->query($check_name_query);

            foreach($check_result as $row){
                if($row['product_name'] == $product_name){
                    $product_duplicate = true;
                    echo ("<script>alert('Product already in the store!');</script>");
                }
            }
            //Update the data if there is new image
            if ($_FILES['image']['name'] != '') {
                $fileName = $_FILES["image"]["name"];
                $fileSize = $_FILES["image"]["size"];
                $tmpName = $_FILES["image"]["tmp_name"];
                
                $validImageExtension = ['png', 'jpg'];
                $imageExtension = explode('.', $fileName);
                $imageExtension = strtolower(end($imageExtension));
                
                if (!in_array($imageExtension, $validImageExtension)) {
                    echo "<script> alert('Invalid Image Extension'); </script>";
                } else if ($fileSize > 1000000) {
                    echo "<script> alert('Image Size Is Too Large'); </script>";
                } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;
                $destinationPath = '../products/' . $newImageName;
                $res = move_uploaded_file($tmpName, $destinationPath);
                
                $select_query = "select product_name from `tbproducts`";
                $query_result = $conn->query($select_query);
        
                
                if(!$product_duplicate){

                    $updateQuery = "UPDATE `tbproducts` SET
                    `product_name` = '$product_name',
                    `product_description` = '$product_description',
                    `product_category` = '$product_name',
                    `product_sport` = '$product_sport',
                    `product_size` = '$product_size',
                    `product_stocks` = '$product_quantity',
                    `product_image` = '$newImageName',
                    `product_brand` = '$product_brand',
                    `product_price` = '$product_price'
                    WHERE `product_id` = $productID";

                    if($conn->query($updateQuery) === TRUE){
                        echo ("<script>alert('Product Updated!');</script>");
                        header('location: add-items.php');
                    }else{
                        echo ("<script>alert('Product not Updated!');</script>");
                    }
                }
            }

        }else {
            //Update the data if there is no new image
            if(!$product_duplicate){
                
                $updateQuery = "UPDATE `tbproducts` SET
                `product_name` = '$product_name',
                `product_description` = '$product_description',
                `product_category` = '$product_category',
                `product_sport` = '$product_sport',
                `product_size` = '$product_size',
                `product_stocks` = '$product_quantity',
                `product_brand` = '$product_brand',
                `product_price` = '$product_price'
                WHERE `product_id` = $productID";

                if($conn->query($updateQuery) === TRUE){
                    echo ("<script>alert('Product Updated!');</script>");
                    header('location: add-items.php');
                }else{
                    echo ("<script>alert('Product not Updated!');</script>");
                }
            }
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/edit-items.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>VULCAN - Update Products</title>
</head>
<body>
<div class="edit-item-container">
        <?php
            include("../php/dashboard.php");
        ?>
        <div class="form-container">
         <div class="back">
         <a href="add-items.php"><i class="fa-solid fa-left-long"></i></a>
         </div>
            <form method="POST" class="form" enctype="multipart/form-data">
                <h1>Update Product</h1>
                 <div id="data">
                    
                 <div class="form-labels-one">
                        <div class="labels">
                            <label for="txt-product-name">Product Name:</label>
                            <label for="image">Image: </label>
                            <label for="txt-brand">Brand:</label>
                            <label for="txt-sports">Sports: </label>
                            <label for="txt-description">Description: </label>
                        </div>
                        <div class="inputs">
                            <input type="text" name="txt-product-name" id="txt-product-name" value="<?php echo $productName; ?>" required>


                            <!-- Edit This MJ -->

                            <div>
                                <img src="../products/<?php echo $productImage; ?>" width="150px" height="150px" alt="">
                                <input type="file" name="image" id="image">
                            </div>                           


                            <input type="text" name="txt-brand" id="txt-brand" value="<?php echo $productBrand; ?>" required>
                            <input type="text" name="txt-sports" id="txt-sports" value="<?php echo $productSport; ?>" required>
                            <input type="text" name="txt-product-description" id="txt-product-description" value="<?php echo $productDescription; ?>" required>
                        </div>
       
                    </div>
                    <div class="form-labels-two">
                        <div class="labels">
                            <label for="txt-size">Size: </label>
                            <label for="txt-category">Category: </label>
                            <label for="txt-quantity">Quantity: </label>
                            <label for="txt-price">Price: </label>
                        </div>
                        <div class="inputs">
                            <input type="text" name="txt-size" id="txt-size" value="<?php echo $productSize; ?>" required>
                            <input type="text" name="txt-category" id="txt-category" value="<?php echo $productCategory; ?>" required>
                            <input type="text" name="txt-quantity" id="txt-quantity" value="<?php echo $productStocks; ?>" required>
                            <input type="text" name="txt-price" id="txt-price" value="<?php echo $productPrice; ?>" required>
                        </div>
                    </div>
                 </div>
                    <input type="submit" class="edit-btn" value="SAVE" name="btnEdit">
                    <button onclick="cancel()">Cancel</button>                  
            </form>
            </div>
    </div>

    <script>
         function cancel() {
            // Get the form element
            let form = document.getElementById("form");

            // Reset the form, which clears all input fields
            form.reset();

            // Clear the file input (set its value to an empty string)
            document.getElementById("image").value = "";
        }
    </script>   
</body>
</html>