<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/login.css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Vulcan - Sign In</title>
</head>

<body>       
  
  <div class="back">
      <a href="landing-page.php">
          <i class="fa-solid fa-chevron-left"></i>                     
          <span>Back</span>
      </a>
  </div>
  <div class="form-container">
    <div class ="row-title-and-exit">
    <img src="../assets/imgs/Vulcan Logo.png" alt="" height="100px" width="100px">
        <h1>SIGN IN</h1>
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
      <input type="submit" class="login-btn" name="btnLogin" value="SIGN IN" />
      <p class="forgot-pass-text">Forgot password?</p>
      <p>Don't have an account? <a href="register.php">Sign Up now</a></p>
    </form>
  </div>
  
  <?php
    include("conn.php");
    
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if($stmt = $conn->prepare('select user_id, user_password, acc_type from tbusers where user_email = ?')){
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows() > 0){
          $stmt->bind_result($id, $password,$accType);
          $stmt->fetch();
          
          $verify = password_verify($_POST['password'], $password);
          if($verify){
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['id'] = $id;
            $_SESSION['acc_type'] = $accType;

            if($accType === 'customer'){
              header('Location: landing-page.php');
            }else if($accType === 'admin' || $accType == 'seller'){
              header('Location: dashboard-page.php');
            }
  
          }else{
            echo ("<script>alert('Incorrect password');</script>");
          }
  
        }else{
          echo ("<script>alert('Incorrect username');</script>");
        }
  
        $stmt->close();
  
      }
    }

  ?>

</html>