<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/edit-items.css">
    <title>VULCAN </title>
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
                <h1>UPDATE PRODUCT</h1>
                 <div id="data">
                    
                 <div class="form-labels-one">
                        <div class="labels">
                            <label for="txt-product-name">Product Name:</label>
                            <label for="image">Image: </label>
                            <label for="txt-brand">Brand:</label>
                            <label for="txt-sports">Sports: </label>
                        </div>
                        <div class="inputs">
                            <input type="text" name="txt-product-name" id="txt-product-name" required>
                            <input type="file" name="image" id="image" required>
                            <input type="text" name="txt-brand" id="txt-brand" required>
                            <input type="text" name="txt-sports" id="txt-sports" required>
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
                            <input type="text" name="txt-size" id="txt-size" required>
                            <input type="text" name="txt-category" id="txt-category" required>
                            <input type="text" name="txt-quantity" id="txt-quantity" required>
                            <input type="text" name="txt-price" id="txt-price" required>
                        </div>
                    </div>
                 </div>
                    <input type="submit" class="edit-btn" value="SAVE" name="btnEdit">
            </form>
            </div>
    </div>
</body>
</html>