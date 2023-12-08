<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    $userID = $_SESSION['id'];

    $selectQuery = 'SELECT p.product_id, p.product_name, p.product_image, p.product_price, p.product_stocks, c.cart_product_size, c.cart_quantity
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

        function updateQuantity(input, productId) {
            var quantity = input.value;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "update_quantity.php?product_id=" + productId + "&quantity=" + quantity, true);
            xhr.send();

            updateSubtotal(input.parentNode.parentNode);
        }

        function updateSubtotal(row) {
            var quantityInput = row.querySelector('input[name="quantity[]"]');
            var priceCell = row.cells[5];
            var subtotalCell = row.cells[6];
            var quantity = parseInt(quantityInput.value);
            var priceText = priceCell.textContent.replace(/[^\d.]/g, '');
            var price = parseFloat(priceText);
            var subtotal = quantity * price;
            subtotalCell.textContent = '₱' + subtotal.toFixed(2);
            updateTotal();
        }

        function updateTotal() {
            var total = 0;
            var subtotalCells = document.querySelectorAll('td:nth-child(7)');

            subtotalCells.forEach(function(subtotalCell) {
                var subtotalText = subtotalCell.textContent.replace(/[^\d.]/g, '');
                total += parseFloat(subtotalText);
            });
        
            var totalAmountElement = document.getElementById('totalAmount');
            totalAmountElement.textContent = 'Total: ₱' + total.toFixed(2);
        }
    </script>
</head>
<body>
    <div class="cart-container">
        <?php include "header.php"?>
        <div class="container">
            <h1 class="title2">Your Cart <i class="fa-solid fa-cart-shopping"></i></h1>
            <div class="cart-table">
                <form action="" method="post">
                    <table>
                        <tr>
                            <th>Select</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $total = 0;
                            foreach ($query_result as $row) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='select[]'></td>";
                                echo "<td><img src='../products/{$row['product_image']}' alt='Product Image' width='200'></td>";
                                echo "<td>{$row['product_name']}</td>";
                                echo "<td>{$row['cart_product_size']}</td>";
                                echo "<td><input type='number' name='quantity[]' value='{$row['cart_quantity']}' min='1' max='{$row['product_stocks']}' onchange='updateQuantity(this, {$row['product_id']})'></td>";
                                echo "<td>₱{$row['product_price']}</td>";
                                $subtotal = $row['product_price'] * $row['cart_quantity'];
                                echo "<td>₱{$subtotal}</td>";

                                echo "<td><button type='submit' name='delete_btn'>Delete</button></td>";
                                echo "</tr>";
                                $total += $subtotal;
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php include "check-out.php"?>
</body>
</html>