<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/login.css">
  <link rel="stylesheet" type="image/x-icon" href="../assets/imgs/logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>VULCAN SPORT SIGN IN</title>
</head>

<body>
  <div class="form-container">
    <h1><img src="../assets/imgs/logo.png" alt="" height="50" width="50">SIGN IN</h1>
    <form method="POST" class="form">

      <div class="form-input">
        <label>Email:</label>
        <input type="email" name="email" placeholder="example@gmail.com" required />
      </div>

      <div class="form-input">
      <label>Password:</label>
        <input type="password" name="password" placeholder="***************" required min="8" max="16" />
      </div>
      <input type="submit" class="login-btn" name="btnLogin" value="SIGN IN" />
      <span>Forgot password?</span>
      <p>Don't have an account? <a href="register.php">Sign Up now</a></p>
    </form>
  </div>