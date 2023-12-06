<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/seller-account.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>VULCAN - Seller Account</title>
</head>
<body>
<div class="seller-container">
        <?php include("../php/dashboard.php"); ?>
        <div class="form-container">
            <h1 class="title">Seller Account</h1>
            <form method="POST" class="first-form" enctype="multipart/form-data">
                <div class="data">
                    <div class="labels">
                        <label for="txt-fullname">Email:</label>
                        <label for="txt-username">Username:</label>
                        <label for="txt-address">Address:</label>
                        <label for="txt-phonenumber">Phone number:</label>
                        <label for="txt-password">Password:</label>
                        <label for="txt-confirmpassword">Confirm Password:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" name="txt-email" id="txt-email" required>
                        <input type="text" name="txt-username" id="txt-username" required>
                        <input type="text" name="txt-address" id="txt-address" required>
                        <input type="text" name="txt-phonenumber" id="txt-phonenumber" required>
                        <input type="password" name="txt-password" id="txt-password" required>
                        <input type="password" name="txt-confirmpassword" id="txt-confirmpassword" required>
                        <input type="submit" name="add-btn" id="add-btn" value="Add Seller">
                    </div>        
            </form>
        </div>
        <div class="table-actions">
        <div class="delete-container">
            <button type="button" onclick="handleDelete()"><i class="fa-solid fa-trash"><span class="delete"> Delete</span></i></button>
        </div>
        <div class="product-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Search Items...">
        </div>
    </div>
    <div class="product-table">
        <table>
            <tr>
                <th>Select</th>
                <th>Email</th>
                <th>Username</th>
                <th>Address</th>
                <th>Phonenumber</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>user@gmail.com</td>
                <td>user</td>
                <td>Balbul</td>
                <td>091232323232</td>
                <td><a href="seller.php" style="text-decoration:none; color: black;"><i class='fa-solid fa-pen-to-square'></a></i></td>
            </tr>
        </table>
    </div>
    </div>
</body>
</html>