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
                        <label for="txt-fullname">Fullname:</label>
                        <label for="txt-username">Username:</label>
                        <label for="image">Image:</label>
                        <label for="txt-address">Address:</label>
                        <label for="txt-phonenumber">Phone number:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" name="txt-fullname" id="txt-fullname" required>
                        <input type="text" name="txt-username" id="txt-username" required>
                        <input type="file" name="image" id="image" required>
                        <input type="text" name="txt-address" id="txt-address" required>
                        <input type="text" name="txt-phonenumber" id="txt-phonenumber" required>
                    </div>
                </div>
                <input type="submit" name="change-info" id="change-info" value="Save Changes">
            </form>
            <form method="POST" class="second-form">
            <h1 class="title">Change Password</h1>
                <div class="data">
                    <div class="labels">
                        <label for="txt-password">Password:</label>
                        <label for="txt-confirmpassword">Confirm Password:</label>
                    </div>
                    <div class="inputs">
                        <input type="password" name="txt-password" id="txt-password" required>
                        <input type="password" name="txt-confirmpassword" id="txt-confirmpassword" required>
                    </div>
                </div>
                <input type="submit" name="change-pass" id="change-pass" value="Change Password">
            </form>
        </div>
    </div>
</body>
</html>