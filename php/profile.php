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
    <form method="GET">
        <h1>PROFILE</h1>
    <div class="profile-picture-container">
        <input type="file" id="profile-picture" class="txt-file">
        <img src="../assets/imgs/bag.jpg" alt="Profile Picture" class="profile-picture">
    </div>
        <label for="">Fullname</label>
        <input type="text">
        <label for="">Username</label>
        <input type="text">
        <label for="">Address</label>
        <input type="text">
        <label for="">Phone Number</label>
        <input type="tel">
        <label for="">Email</label>
        <input type="text">
        <label for="">Password</label>
        <input type="password">
        <input type="submit" name="submit-btn" value="SAVE">
    </form>
    <div class="user-table">
        <span>MY ORDERS</span>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Size</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Order Date</th>
                <th>Order Arrival Date</th>
                <th>Order Status</th>
            </tr>
            <tr>
                <td>YOYO</td>
                <td>basta</td>
                <td>100</td>
                <td>2000</td>
                <td>06-12-2023</td>
                <td>12-11-2023</td>
                <td>Delivered</td>
            </tr>
            <tr>
                <td>YOYO</td>
                <td>basta</td>
                <td>100</td>
                <td>2000</td>
                <td>06-12-2023</td>
                <td>12-11-2023</td>
                <td>Delivered</td>
            </tr>
        </table>
    </div>
    </div>
</body>
</html>