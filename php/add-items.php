<?php
    include('conn.php');
    session_start();

    if(isset($_POST["btnAdd"])){
        $product_name = $_POST['txt-product-name'];
        $product_brand = $_POST['txt-brand'];
        $product_size = $_POST['txt-size'];
        $product_category = $_POST['txt-category'];
        $product_quantity = $_POST['txt-quantity'];
        $product_price = $_POST['txt-price'];
        $product_sport = $_POST['txt-sports'];

        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        
        $validImageExtension = ['png','jpg'];
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
    
            $product_duplicate = false;
    
            foreach($query_result as $row){
                if($row['product_name'] == $product_name){
                    echo ("<script>alert('Product already in the store!');</script>");
                    $product_duplicate = true;
                }
            }
    
            if(!$product_duplicate){
                $insert_query = "insert into `tbproducts`(`product_name`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`,`product_brand`, `product_price`) values ('$product_name','$product_category','$product_sport','$product_size','$product_quantity','$newImageName','$product_brand','$product_price')";
                if($conn->query($insert_query) === TRUE){
                    echo ("<script>alert('Product Added!');</script>");
                }else{
                    echo ("<script>alert('Product not Added!');</script>");
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
    <link rel="stylesheet" href="../styles/add-items.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <div class="add-item-container">
        <?php
            include("../php/dashboard.php");
        ?>
        <div class="form-container">
        <form method="POST" class="form" enctype="multipart/form-data">
                <h1>ADD PRODUCTS</h1>
                    <div class="form-labels-one">
                        <label for="txt-product-name">Product Name: <input type="text" name="txt-product-name" id="txt-product-name" required></label>
                        <label for="image">Image: <input type="file" name="image" id="image" required></label>
                        <label for="txt-brand">Brand: <input type="text" name="txt-brand" id="txt-brand" required></label>
                        <label for="txt-sports">Sports: <input type="text" name="txt-sports" id="txt-sports" required></label>
                    </div>
                    <div class="form-labels-two">
                        <label for="txt-size">Size: <input type="text" name="txt-size" id="txt-size" required></label>
                        <label for="txt-category">Category: <input type="text" name="txt-category" id="txt-category" required></label>
                        <label for="txt-quantity">Quantity: <input type="text" name="txt-quantity" id="txt-quantity" required></label>
                        <label for="txt-price">Price: <input type="text" name="txt-price" id="txt-price" required></label>
                    </div>
                        <input type="submit" class="add-btn" value="Add Product" name="btnAdd">
            </form>
                <div class="product-search">
                    <span>PRODUCT</span>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Search Items...">
                </div>
                <!--Table-->
                <div class="product-table">
                    <table style="width:100%">
                        <tr>
                            <th>Action</th>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Sports</th>
                            <th>Total</th>
                            <th>Price per Item</th>
                            <th>Edit</th>
                        </tr>

                        <?php
                            $sql = "select `product_id`, `product_name`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price` from `tbproducts`";
                            $result = $conn->query($sql);
                    
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td><input type = 'checkbox' name = '' id = ''></td>";
                                echo "<td>" . $row["product_id"] . "</td>";
                                echo "<td><img src='../products/" . $row["product_image"] . "' width='200'></td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["product_brand"] . "</td>";
                                echo "<td>" . $row["product_category"] . "</td>";
                                echo "<td>" . $row["product_sport"] . "</td>";
                                echo "<td>" . $row["product_stocks"] . "</td>";
                                echo "<td>" . $row["product_price"] . "</td>";
                                echo "<td><i class = 'fa-solid fa-pen-to-square'></i></td>";
                                echo "</tr>";
                            }
                        ?>

                    </table>
                </div>
            </div>
    </div>
</body>
</html>