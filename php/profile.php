<?php
    include('conn.php');
    session_start();
    $loggedIn = isset($_SESSION['loggedin']);
    $userID = $_SESSION['id'];

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    $userDetailsQuery = "SELECT * FROM tbusers WHERE user_id = $userID";
    $userDetailsResult = $conn->query($userDetailsQuery);
    $userDetails = $userDetailsResult->fetch_assoc();

    $selectQuery = 'SELECT
        tborders.order_id,
        tborders.product_id,
        tborders.order_product_size,
        tbproducts.product_name,
        tbproducts.product_price,
        tborders.user_id,
        tbusers.user_username,
        tborders.order_quantity,
        tborders.order_price,
        tborders.order_payment_method,
        tborders.order_address,
        tborders.order_date,
        tborders.order_arrival_date,
        tborders.order_status
    FROM
        tborders
    INNER JOIN
        tbproducts ON tborders.product_id = tbproducts.product_id
    INNER JOIN
        tbusers ON tborders.user_id = tbusers.user_id
    WHERE
        tborders.order_id LIKE "%' . $search . '%"
        OR tbproducts.product_name LIKE "%' . $search . '%"
        OR tbusers.user_username LIKE "%' . $search . '%"
        OR tborders.order_quantity LIKE "%' . $search . '%"
        OR tborders.order_price LIKE "%' . $search . '%"
        OR tborders.order_payment_method LIKE "%' . $search . '%"
        OR tborders.order_address LIKE "%' . $search . '%"
        OR tborders.order_date LIKE "%' . $search . '%"
        OR tborders.order_arrival_date LIKE "%' . $search . '%"
        OR tborders.order_status LIKE "%' . $search . '%"
        OR tborders.order_product_size LIKE "%' . $search . '%"';
        
    $result = $conn->query($selectQuery);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-btn'])) {
        $userID = $_SESSION['id'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];

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
            $destinationPath = '../user_image/' . $newImageName;
            $res = move_uploaded_file($tmpName, $destinationPath);

            $updateImage = "UPDATE `tbusers` SET
                `user_image`='$newImageName'
            WHERE `user_id`='$userID'";
            $updateImageResult = $conn->query($updateImage);
        }

        // Check if the user provided a new password
        if (!empty($password)) {
            // Hash the new password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Update user data with the new password
            $updateQuery = "UPDATE `tbusers` SET
                `user_fullName`='$fullname',
                `user_username`='$username',
                `user_password`='$hashedPassword',
                `user_email`='$email',
                `user_contactNo`='$phoneNumber',
                `user_address`='$address'
            WHERE `user_id`='$userID'";
        } else {
            // Update user data without changing the password
            $updateQuery = "UPDATE `tbusers` SET
                `user_fullName`='$fullname',
                `user_username`='$username',
                `user_email`='$email',
                `user_contactNo`='$phoneNumber',
                `user_address`='$address'
            WHERE `user_id`='$userID'";
        }
        
        $updateResult = $conn->query($updateQuery);
        echo ("<script>alert('Profile Updated');</script>");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/profile.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>Vulcan - Profile</title>
</head>
<body>
    <div class="class-container">
    <form method="POST">
        <h1>PROFILE</h1>
    <div class="profile-picture-container">
        <input type="file" name="image" id="image">
        <img src="../user_image/" alt="Profile Picture" class="profile-picture">
    </div>
        <label for="fullname">Fullname</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $userDetails['user_fullName']; ?>">
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $userDetails['user_username']; ?>">
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $userDetails['user_address']; ?>">
            
            <label for="phoneNumber">Phone Number</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $userDetails['user_contactNo']; ?>">
            
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $userDetails['user_email']; ?>">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        <input type="submit" name="submit-btn" value="SAVE">
    </form>
    <div class="user-table">
        <span>MY ORDERS</span>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Product Size</th>
                <th>Quantity</th>
                <th>Price Per Product</th>
                <th>Subtotal</th>
                <th>Payment Method</th>
                <th>Address</th>
                <th>Order Date</th>
                <th>Order Arrived Date</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['product_name'] . '</td>';
                    echo '<td>' . $row['order_product_size'] . '</td>';
                    echo '<td>' . $row['order_quantity'] . '</td>';
                    // Calculate and display price per product
                    $pricePerProduct = $row['order_price'] / $row['order_quantity'];
                    echo '<td>' . $pricePerProduct . '</td>';
                    echo '<td>' . $row['order_price'] . '</td>';
                    echo '<td>' . $row['order_payment_method'] . '</td>';
                    echo '<td>' . $row['order_address'] . '</td>';
                    echo '<td>' . $row['order_date'] . '</td>';
                    echo '<td>' . $row['order_arrival_date'] . '</td>';
                    echo '<td>' . $row['order_status'] . '</td>';
                    if ($row['order_status'] === 'Pending' || $row['order_status'] === 'In Transit') {
                        echo '<td><button class="cancel-btn" type="button" name="cancel-btn" onclick="cancelOrder(' . $row['order_id'] . ', \'' . $row['order_date'] . '\', \'' . $row['order_status'] . '\')">Cancel</button></td>';
                    } else if ($row['order_status'] === 'Delivered') {
                        echo '<td><button class="cancel-btn" type="button" name="cancel-btn" onclick="returnOrder(' . $row['order_id'] . ', \'' . $row['order_arrival_date'] . '\', \'' . $row['order_status'] . '\')">Return</button></td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    </div>
</body>


<script>
    function cancelOrder(orderId, orderDate, orderStatus) {
        if (orderStatus === 'In Transit') {
            alert('This order is already in transit and cannot be cancelled.');
        } else {
            if (confirm('Are you sure you want to cancel this order?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        location.reload();
                    }
                };
                xhr.open("GET", "cancel-order.php?order_id=" + orderId, true);
                xhr.send();
            }
        }
    }

    function returnOrder(orderId, arrivalDate, orderStatus) {
        var currentDate = new Date();

        // Check if the current date is 3 days or more after the arrival date
        var threeDaysLater = new Date(arrivalDate);
        threeDaysLater.setDate(threeDaysLater.getDate() + 3);

        if (currentDate > threeDaysLater) {
            alert('The order is already past the return period.');
        } else {
            if (confirm('Are you sure you want to return this order?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        location.reload();
                    }
                };
                xhr.open("GET", "return-order.php?order_id=" + orderId, true);
                xhr.send();
            }
        }
    }
</script>

</html>