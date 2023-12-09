<?php
        include('conn.php');
        session_start();
        $loggedIn = isset($_SESSION['loggedin']);
        $userID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="../styles/card-payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vulcan - Card Payment</title>
</head>
<body>
    <div class="card-payment-container">
        <?php include "header.php"?>
        <div class="container">
        <div class="back">
            <a href="place-order.php">
                <i class="fa-solid fa-chevron-left"></i>                     
                <span>Back</span>
            </a>
        </div>
            <div class="title">
                    <span>Card Payment</span>
                </div>
            <div class="payment-container">
                  <div class="card">
                    <img src="../assets/imgs/landbank.png" alt="" />
                  </div>
                  <div class="card">
                    <img src="../assets/imgs/bdo.png" alt="" />
                  </div>
                  <div class="card">
                    <img src="../assets/imgs/mastercard.png" alt="" />
                  </div>
                  <div class="card">
                    <img src="../assets/imgs/visa.png" alt="" />
                  </div>
            </div>
            <div class="number">
                <label for="card-number">Enter your Account Number: </label>
                <input type="text" name="card-number" class="card-number" placeholder="XXXX-XXXX">
                <button type="submit">BUY</button>
            </div>
        </div>
    </div>
    <?php include ("footer.php"); ?> 
</body>
</html>