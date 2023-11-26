<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/register.css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>VULCAN SPORT SIGN UP</title>
</head>

<body>
  <div class="form-container">
    <h1><img src="../assets/imgs/Vulcan Logo.png" alt="" height="50" width="50"> SIGN UP</h1>
    
    <form method="POST" class="form">
      <div class="form-input">
        <label>Full Name:</label>
        <input type="text" name="fullName" required />
      </div>

      <div class="form-input">
        <label>Username:</label>
        <input type="text" name="username" required />
      </div>

      <div class="form-input">
        <label>Password:</label>
        <input type="password" name="password" required min="8" max="16" />
      </div>
      <div class="form-input">
        <label>Confirm Password:</label>
        <input type="password" name="confirmPassword" required min="8" max="16" />
      </div>

      <div class="form-input">
        <label>Email:</label>
        <input type="email" name="email" required />
      </div>

      <div class="form-input">
        <label>Contact Number:</label>
        <input type="text" name="contactNumber" required min="11" max="11" />
      </div>

      <div class="form-input">
        <label>Address:</label>
        <input type="text" name="address" required />
      </div>
      <input type="submit" class="submit-btn" name="btnSubmit" value="SIGN UP" />
      <p class="have-account">Have already an account? <a href="login.php">Login here</a></p>      
    </form>
  </div>

  <?php
  include("conn.php");

  if (isset($_POST["btnSubmit"])) {
    $full_name = $_POST["fullName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmPassword"];
    $email = $_POST["email"];
    $contact_number = $_POST["contactNumber"];
    $address = $_POST["address"];

    $select_query = "select user_username, user_email from `tbusers`";
    $query_result = $conn->query($select_query);

    $user_duplicate = false;
    $email_duplicate = false;

    foreach ($query_result as $row) {
      if ($row["user_username"] == $username && $row["user_email"] == $email) {
        echo ("<script>alert('Username and Email already taken!');</script>");
        $user_duplicate = true;
        $email_duplicate = true;
      } else if ($row["user_email"] == $email) {;
        echo ("<script>alert('Email already taken!');</script>");
        $email_duplicate = true;
      } else if ($row["user_username"] == $username) {
        echo ("<script>alert('Username already taken!');</script>");
        $user_duplicate = true;
      }
    }

    if (!$user_duplicate && !$email_duplicate) {
      if ($password == $confirm_password) {
        $insert_query = "insert into tbusers (`user_fullName`, `user_username`, `user_password`, `user_email`, `user_contactNo`, `user_address`,`acc_type`) values ('$full_name','$username','$password','$email','$contact_number','$address', 'customer')";
        if ($conn->query($insert_query) === TRUE) {
          echo ("<script>alert('Sign up Successful!');</script>");
          header('location: login.php');
        } else {
          echo ("<script>alert('Sign up Failed!');</script>");
        }
      } else {
        echo ("<script>alert('Password and Confirm Password do not match!');</script>");
      }
    }
  }

  ?>
</body>

</html>