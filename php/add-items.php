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
        $product_description = $_POST['txt-product-description'];

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
                    $product_duplicate = true;
                    echo ("<script>alert('Product already in the store!');</script>");
                }
            }
    
            if(!$product_duplicate){
                $insert_query = "insert into `tbproducts`(`product_name`, `product_description` ,`product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`,`product_brand`, `product_price`) values ('$product_name','$product_description','$product_category','$product_sport','$product_size','$product_quantity','$newImageName','$product_brand','$product_price')";
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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vulcan - Add Items</title>
</head>
<body>
    <div class="add-item-container">
        <?php
            include("../php/dashboard.php");
        ?>
        <div class="form-container">
            <form method="POST" class="form" enctype="multipart/form-data">
                <h1>Add Product</h1>
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
                            <input type="text" name="txt-product-name" id="txt-product-name" required>
                            <input type="file" name="image" id="image" required>
                            <select name="txt-brand" id="txt-brands" required>
                                <option value="Adidas">Adidas</option>
                                <option value="Asics">Asics</option>
                                <option value="Mikasa">Mikasa</option>
                                <option value="Molten">Molten</option>
                                <option value="Nike">Nike</option>
                                <option value="Puma">Puma</option>
                                <option value="Speedo">Speedo</option>
                                <option value="Yonex">Yonex</option>
                            </select>
                            <select name="txt-sports" id="txt-sports" required>
                                <option value="General">General</option>
                                <option value="Football">Football</option>
                                <option value="Basketball">Basketball</option>
                                <option value="Tennis">Tennis</option>
                                <option value="Football">Badminton</option>
                                <option value="Football">Baseball</option>
                                <option value="Basketball">Swimming</option>
                                <option value="Tennis">Volleyball</option>
                            </select>
                            <input type="text" name="txt-product-description" id="txt-product-description" required>
                        </div>
       
                    </div>
                    <div class="form-labels-two">
                        <div class="labels">
                            <label for="txt-category">Category: </label>
                            <label for="txt-size">Size: </label>
                            <label for="txt-quantity">Quantity: </label>
                            <label for="txt-price">Price: </label>
                        </div>
                        <div class="inputs">

                            <select name="txt-category" id="txt-category" onchange="changeSize()" required>
                                <option value="Tops">Tops</option>
                                <option value="Shoes">Shoes</option>
                                <option value="Accessories and Equipment">Accessories and Equipment</option>
                                <option value="Bottoms">Bottoms</option>
                                <option value="Innerwear">Innerwears</option>
                            </select>

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
                            
                            <input type="text" name="txt-quantity" id="txt-quantity" required>
                            <input type="text" name="txt-price" id="txt-price" required>
                        </div>
                    </div>
                 </div>
                 <div class="action">
                    <input type="submit" class="add-btn" value="Add Product" name="btnAdd">  
                    <button onclick="cancel()" class="cancel-btn">Cancel</button>      
                 </div>                
            </form>
                <div class="table-actions">
                    <div class="delete-container">
                        <button type="button" class="delete-action" onclick="handleDelete()"><i class="fa-solid fa-trash"><span class="delete"> Delete</span></i></button>
                    </div>

                    <div class="product-search">                        
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <form method="GET" action="" id="searchForm">
                            <input type="search" name="search" placeholder="Search Items..."  value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">                            
                        </form>
                    </div>                   
                </div>

                <!--Table-->
                <div class="product-table">
                    
                    <form method = 'POST' action='./delete-items.php' id="productsForm">
                    <table>
                        <tr>
                            <th>Select</th>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Sports</th>
                            <th>Qty</th>
                            <th>Price per Item</th>
                            <th>Action</th>
                        </tr>

                        <?php
                            include('conn.php');
                            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                            $sql = "select `product_id`, `product_name`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price` from `tbproducts` where `product_name` like '%$searchTerm%' order by product_stocks desc";
                            $result = $conn->query($sql);
                            
                            while($row = $result->fetch_assoc()){
                                if($row["product_stocks"] == 0){
                                    echo "<tr class='archived'>";
                                    echo "<td class='check'><input type = 'checkbox' name = 'product_ids[]' value = '".$row['product_id']."' disabled></td>";
                                }else{
                                    echo "<tr>";
                                    echo "<td class='check'><input type = 'checkbox' name = 'product_ids[]' value = '".$row['product_id']."'></td>";
                                }
                                echo "<td>" . $row["product_id"] . "</td>";
                                echo "<td><img src='../products/" . $row["product_image"] . "' width='200'></td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["product_brand"] . "</td>";
                                echo "<td>" . $row["product_category"] . "</td>";
                                echo "<td>" . $row["product_sport"] . "</td>";
                                echo "<td>" . $row["product_stocks"] . "</td>";
                                echo "<td>" . $row["product_price"] . "</td>";
                                echo "<td class='actions'>";                                
                                echo '<a href = "./edit-items.php?id='. $row["product_id"].'">';
                                echo "<i class='fa-solid fa-pen-to-square'></i></a>";                                
                                echo "</a>";
                                echo "</td>";
                                echo "</tr>";
                            }                                 
                        ?>
                    </table>
                    </form>
                </div>
            </div>
    </div>  
    <script>        
        function handleDelete(){
            let form = document.getElementById("productsForm");
            let checkboxes = form.querySelectorAll('input[name="product_ids[]"]:checked');

            if (checkboxes.length === 0) {
                alert("Please select at least one product to delete.");
            }else{
                if (confirm("Are you sure you want to put the product off sale?") == true) { 
                    form.submit();  
                } else {                   
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = false;
                    });      
                    alert("Action Cancelled");
                }
            }
        }

        function cancel() {
            // Get the form element
            let form = document.getElementById("form");

            // Reset the form, which clears all input fields
            form.reset();

            // Clear the file input (set its value to an empty string)
            document.getElementById("image").value = "";
        }

        document.querySelector('input[name="search"]').addEventListener('keydown', (event) =>{
                if(event.keyCode === 13){
                    document.getElementById("searchForm").submit();
                }
            })
            
        function changeSize(){
            if(document.getElementById("txt-category").value == "Tops" || document.getElementById("txt-category").value == "Bottoms" || document.getElementById("txt-category").value == "Innerwears"){
                document.getElementById("clothing-sizes").style.display = "flex";
                document.getElementById("shoes-sizes").style.display = "none";
                document.getElementById("acseqpmnt-sizes").style.display = "none";
            }else if(document.getElementById("txt-category").value == "Shoes"){
                document.getElementById("clothing-sizes").style.display = "none";
                document.getElementById("shoes-sizes").style.display = "flex";
                document.getElementById("acseqpmnt-sizes").style.display = "none";
            }else if(document.getElementById("txt-category").value == "Accessories and Equipment"){
                document.getElementById("clothing-sizes").style.display = "none";
                document.getElementById("shoes-sizes").style.display = "none";
                document.getElementById("acseqpmnt-sizes").style.display = "flex";
            }
        }
        
    </script>
</body>
</html>