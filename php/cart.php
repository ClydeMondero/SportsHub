<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    $userID = $_SESSION['id'];

    $selectQuery = 'SELECT c.cart_id, p.product_id, p.product_name, p.product_image, p.product_price, p.product_stocks, c.cart_product_size, c.cart_quantity
                FROM tbcarts c
                JOIN tbproducts p ON c.product_id = p.product_id WHERE user_id = '.$userID;

    $query_result = $conn->query($selectQuery);
    foreach ($query_result as $row) {
        $productID = $row['product_id'];
        $productName = $row['product_name'];
        $productImage = $row['product_image'];
        $productPrice = $row['product_price'];
        $productSize = $row['cart_product_size'];
        $productQuantity = $row['cart_quantity'];
        $productStock = $row['product_stocks'];
    }         
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vulcan - Shopping Cart</title>
    <script>

        function updateQuantity(input, cartId, productSize) {
            var quantity = input.value;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "update_quantity.php?cart_id=" + cartId + "&quantity=" + quantity + "&size=" + encodeURIComponent(productSize), true);
            xhr.send();

            updateSubtotal(input.parentNode.parentNode);
        }

        function updateSubtotal(row) {
            var quantityInput = row.querySelector('input[name="quantity[]"]');
            var priceCell = row.cells[5];
            var subtotalCell = row.cells[7];
            var quantity = parseInt(quantityInput.value);
            var priceText = priceCell.textContent.replace(/[^\d.]/g, '');
            var price = parseFloat(priceText);
            var subtotal = quantity * price;
            subtotalCell.textContent = '₱' + subtotal.toFixed(2);
        }

        function updateTotal() {
            var total = 0;
            var subtotalCells = document.querySelectorAll('td:nth-child(8)'); // Update the index based on your table structure

            subtotalCells.forEach(function(subtotalCell) {
                var checkbox = subtotalCell.parentNode.querySelector('.cart-checkbox');
                if (checkbox.checked) {
                    var subtotalText = subtotalCell.textContent.replace(/[^\d.]/g, '');
                    total += parseFloat(subtotalText);
                }
            });

            var totalAmountElement = document.getElementById('totalAmount');
            totalAmountElement.textContent = 'Total: ₱' + total.toFixed(2);
        }

        function deleteCartItem(cartId) {
            var confirmation = confirm("Are you sure you want to delete this item from the cart?");
            if (confirmation) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "delete-cart-entry.php?cart_id=" + cartId, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send();
            }
        }

    </script>
</head>
<body>
    <div class="cart-container">
        <?php include "header.php"?>
        <div class="container">
            <div class="back">
                <a href="shopping-page.php?page=shoes&type=categories" >
                    <i class="fa-solid fa-chevron-left"></i>     
                    <span>Back</span>
                </a>
            </div>
            <h1 class="title2">Your Cart <i class="fa-solid fa-cart-shopping"></i></h1>
            <div class="cart-table">
                <form action="cart-check-out.php" method="post" id="checkoutForm">
                    <table>
                        <tr>
                            <th>Select</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Remaining Stock</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $total = 0;
                            if(mysqli_num_rows($query_result) > 0){
                                foreach ($query_result as $row) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' class='cart-checkbox' name='select[]' value='{$row['cart_id']}' onchange='updateTotal()'></td>";
                                    echo "<td><img src='../products/{$row['product_image']}' alt='Product Image' width='200'></td>";
                                    echo "<td>{$row['product_name']}</td>";
                                    echo "<td>{$row['cart_product_size']}</td>";
                                    echo "<td><input class='quantity' type='number' name='quantity[]' value='{$row['cart_quantity']}' min='1' max='{$row['product_stocks']}' onchange='updateQuantity(this, {$row['cart_id']}); updateTotal();'></td>";
                                    echo "<td>₱".number_format($row['product_price'], 2)."</td>";
                                    echo "<td>{$row['product_stocks']}</td>";
                                    $subtotal = $row['product_price'] * $row['cart_quantity'];
                                    echo "<td>₱".number_format($subtotal, 2)."</td>";
                                    echo "<td><button class='remove-btn' type='button' name='delete_btn' onclick='deleteCartItem({$row['cart_id']})'><i class='fa-solid fa-trash'></i><span class='remove'> Delete</span></button></td>";
                                    echo "</tr>";
                                }
                            }else{                                
                                echo "<tr><td colspan='9' class='empty-table'>There's no product in your cart.</td></tr>";                                
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
   
    <?php     
        if(mysqli_num_rows($query_result) > 0){
            include "check-out.php";
        }
    ?>
</body>
</html>