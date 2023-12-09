<?php
include("conn.php");
session_start();
$loggedIn = isset($_SESSION['loggedin']);

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $user_query = "SELECT `user_id`, `user_fullName`, `user_username`, `user_password`, `user_email`, `user_contactNo`, `user_address`, `acc_type` FROM `tbusers` WHERE `user_id` = " . $userID;
    $result = $conn->query($user_query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }

    if (isset($_POST["change-info"])) {
        $full_name = $_POST["txt-fullname"];
        $username = $_POST["txt-username"];
        $email = $_POST["txt-email"];
        $contact_number = $_POST["txt-phonenumber"];
        $address = $_POST["txt-address"];

        $user_duplicate = false;
        $email_duplicate = false;

        // Check for duplicate username
        $check_username_query = "SELECT `user_username` FROM `tbusers` WHERE `user_username` = '$username' AND `user_id` != $userID";
        $check_username_result = $conn->query($check_username_query);

        if ($check_username_result->num_rows > 0) {
            $user_duplicate = true;
            echo ("<script>alert('Username is already taken!');</script>");
        }

        // Check for duplicate email
        $check_email_query = "SELECT `user_email` FROM `tbusers` WHERE `user_email` = '$email' AND `user_id` != $userID";
        $check_email_result = $conn->query($check_email_query);

        if ($check_email_result->num_rows > 0) {
            $email_duplicate = true;
            echo ("<script>alert('Email is already taken!');</script>");
        }

        if (!$user_duplicate && !$email_duplicate) {
            $update_query = "UPDATE `tbusers` SET 
                `user_fullName` = '$full_name',
                `user_username` = '$username',
                `user_email` = '$email',
                `user_address` = '$address',
                `user_contactNo` = '$contact_number'
                WHERE `user_id` = $userID";

            if ($conn->query($update_query) === TRUE) {
                echo ("<script>alert('Seller Account Updated');</script>");
                echo "<script>setTimeout(function() { window.location.href = 'seller-account.php'; }, 1000);</script>";
                exit();
            } else {
                echo ("<script>alert('Update Failed!');</script>");
            }
        }
    }


    if (isset($_POST["change-pass"])) {
        $new_password = $_POST["txt-password"];
        $confirm_password = $_POST["txt-confirmpassword"];
    
        // Check if the new password is different from the existing password
        if ($new_password != $confirm_password) {
            echo ("<script>alert('Passwords do not match!');</script>");
        } else {
            // Check if the new password is different from the existing password
            $current_password_query = "SELECT `user_password` FROM `tbusers` WHERE `user_id` = $userID";
            $current_password_result = $conn->query($current_password_query);
    
            if ($current_password_result->num_rows > 0) {
                $current_password_row = $current_password_result->fetch_assoc();
                $existing_password = $current_password_row['user_password'];
    
                // Check if the new password is different from the existing password
                if (password_verify($new_password, $existing_password)) {
                    echo ("<script>alert('New password must be different from the existing password!');</script>");
                } else {
                    // Hash the new password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
                    // Update the password in the database
                    $update_password_query = "UPDATE `tbusers` SET `user_password` = '$hashed_password' WHERE `user_id` = $userID";
    
                    if ($conn->query($update_password_query) === TRUE) {
                        echo ("<script>alert('Password Updated');</script>");
                        echo "<script>setTimeout(function() { window.location.href = 'seller-account.php'; }, 1000);</script>";
                    } else {
                        echo ("<script>alert('Password Update Failed!');</script>");
                    }
                }
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
    <link rel="stylesheet" href="../styles/seller.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>Vulcan - Seller Account</title>
</head>
<body>
<div class="seller-container">
        <?php include("../php/dashboard.php"); ?>       
        <div class="form-container">   
            <div class="back">
                    <a href="seller-account.php">
                        <i class="fa-solid fa-chevron-left"></i>                     
                        <span>Back</span>
                    </a>
            </div>         
            <h1 class="title">Update Account</h1>
            <form method="POST" class="first-form" enctype="multipart/form-data">
                <div class="data">
                    <div class="labels">
                        <label for="txt-fullname">Fullname:</label>
                        <label for="txt-email">Email:</label>
                        <label for="txt-username">Username:</label>
                        <label for="txt-address">Address:</label>
                        <label for="txt-phonenumber">Phone number:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" name="txt-fullname" id="txt-fullname" value="<?php echo isset($userData['user_fullName']) ? $userData['user_fullName'] : ''; ?>" required>
                        <input type="text" name="txt-email" id="txt-email" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>" required>
                        <input type="text" name="txt-username" id="txt-username" value="<?php echo isset($userData['user_username']) ? $userData['user_username'] : ''; ?>" required>
                        <input type="text" name="txt-address" id="txt-address" value="<?php echo isset($userData['user_address']) ? $userData['user_address'] : ''; ?>" required>
                        <input type="text" name="txt-phonenumber" id="txt-phonenumber" value="<?php echo isset($userData['user_contactNo']) ? $userData['user_contactNo'] : ''; ?>" required>
                    </div>
                </div>
                <input type="submit" name="change-info" id="change-info" value="Save Changes">
            </form>
            <form method="POST" class="second-form">
            <h1 class="title">Change Password</h1>
                <div class="data">
                    <div class="labels">
                        <label for="txt-password">New Password:</label>
                        <label for="txt-confirmpassword">Confirm New Password:</label>
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