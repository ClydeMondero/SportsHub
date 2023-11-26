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
            <form method="POST" class="form">
                <h1>ADD PRODUCTS</h1>
                    <div class="form-labels-one">
                        <label for="txt-product-name">Product Name: <input type="text" name="txt-product-name" id="txt-product-name"></label>
                        <label for="file-image">Image: <input type="file" name="file-image" id="file-image"></label>
                        <label for="txt-brand">Brand: <input type="text" name="txt-brand" id="txt-brand"></label>
                        <label for="txt-sports">Sports: <input type="text" name="txt-sports" id="txt-sports"></label>
                    </div>
                    <div class="form-labels-two">
                        <label for="txt-size">Size: <input type="text" name="txt-size" id="txt-size"></label>
                        <label for="txt-category">Category: <input type="text" name="txt-category" id="txt-category"></label>
                        <label for="txt-quantity">Quantity: <input type="text" name="txt-quantity" id="txt-quantity"></label>
                        <label for="txt-price">Price: <input type="text" name="txt-price" id="txt-price"></label>
                    </div>
                        <input type="submit" class="add-btn" value="Add Product">
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
                            <th>Product Code</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Sports</th>
                            <th>Total</th>
                            <th>Edit</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>1</td>
                            <td><img src="../assets/imgs/sweater.jpg" alt="" width="150" height="150"></td>
                            <td>Sweater Nike</td>
                            <td>Nike</td>
                            <td>Sweater</td>
                            <td>Casual Wear</td>
                            <td>2,300</td>
                            <td><i class="fa-solid fa-pen-to-square"></i></td>
                        </tr>
                    </table>
                </div>
            </div>
    </div>
</body>
</html>