<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/forgot-password.css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Vulcan - Forgot Password</title>
</head>

<body>       
  
  <div class="back">
      <a href="login.php">
          <i class="fa-solid fa-chevron-left"></i>                     
          <span>Back</span>
      </a>
  </div>
  <div class="form-container">
    <div class ="title">
        <img src="../assets/imgs/Vulcan Logo.png" alt="" height="100px" width="100px">
        <h1>Reset Password</h1>
    </div>
    <form method="POST" class="form">
      <div class="form-input">
        <label>Email:</label>
        <input type="email" name="email" placeholder="example@gmail.com" required />
      </div>

      <div class="form-input">
        <label>Password:</label>
        <input type="password" name="password" placeholder="***************" required min="8" max="16" />
      </div>

      <div class="form-input">
        <label>Confirm Password:</label>
        <input type="password" name="confirmPassword" placeholder="***************" required min="8" max="16" />
      </div>

      <input type="submit" class="save-btn" name="saveBtn" value="SAVE" />          
    </form>
  </div>
  
  <?php
    include("conn.php");
    
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirmPassowrd = $_POST["confirmPassword"];

      if($password == $confirmPassowrd){
        $hashedPassowrd = password_hash($password, PASSWORD_DEFAULT);

        $updatePass = "UPDATE `tbusers` SET `user_password`= '$hashedPassowrd' WHERE `user_email` = '$email';";
        
        if ($conn->query($updatePass) === TRUE) {
          echo ("<script>alert('New Password Saved!');</script>");
          header('location: login.php');
        } else {
          echo ("<script>alert('Reset Password Failed!');</script>");
        }
      }else {
        echo ("<script>alert('Password and Confirm Password do not match!');</script>");
      }  
    }

  ?>

</html>