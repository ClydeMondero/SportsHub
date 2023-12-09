<?php
        include('conn.php');
        session_start();
        $loggedIn = isset($_SESSION['loggedin']);
        $userID = $_SESSION['id'];

        $total = $_GET['totalsum'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="../styles/gcash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vulcan - GCash</title>
</head>
<body>
<div class="gcash-payment-container">
        <?php include "header.php"?>
        <div class="container">
            <div class="title">
                    <span><img src="../assets/imgs/gcash.png" alt="gcash logo" height="200px" width="150px" style="object-fit:cover;"></span>
                </div>
            <div class="gcash-container">
                <img src="../assets/imgs/gcash-payment.jpg" alt="Gcash" height="650px" width="550px">
                <span>Amount to Pay: ₱<?php echo number_format($total, 2, '.', ',');?></span>
        </div>
    </div>
</div>
    <?php include ("footer.php"); ?> 
</body>
</html>