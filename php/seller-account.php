<?php
    session_start();
    include("conn.php");

    if ($_SESSION['acc_type'] !== 'admin') {
        echo "<script>alert('Only Admin Accounts can access this page');</script>";
        echo "<script>setTimeout(function() { window.location.href = 'dashboard.php'; }, 1000);</script>";
        exit();
    }

  if (isset($_POST["add-btn"])) {
    $full_name = $_POST["txt-fullname"];
    $username = $_POST["txt-username"];
    $password = $_POST["txt-password"];
    $confirm_password = $_POST["txt-confirmpassword"];
    $email = $_POST["txt-email"];
    $contact_number = $_POST["txt-phonenumber"];
    $address = $_POST["txt-address"];

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
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "insert into tbusers (`user_fullName`, `user_username`, `user_password`, `user_email`, `user_contactNo`, `user_address`,`acc_type`) values ('$full_name','$username','$hashedPassword','$email','$contact_number','$address', 'seller')";
        if ($conn->query($insert_query) === TRUE) {
          echo ("<script>alert('Seller Account Created');</script>");
        } else {
          echo ("<script>alert('Sign up Failed!');</script>");
        }
      } else {
        echo ("<script>alert('Password and Confirm Password do not match!');</script>");
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
    <link rel="stylesheet" href="../styles/seller-account.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>Vulcan - Seller Account</title>
</head>
<body>
<div class="seller-container">
        <?php include("../php/dashboard.php"); ?>
        <div class="form-container">
            <h1 class="title">Seller Account</h1>
            <form method="POST" class="first-form" enctype="multipart/form-data">
                <div class="data">
                    <div class="labels">
                        <label for="txt-fullname">Full Name:</label>
                        <label for="txt-email">Email:</label>
                        <label for="txt-username">Username:</label>
                        <label for="txt-address">Address:</label>
                        <label for="txt-phonenumber">Phone number:</label>
                        <label for="txt-password">Password:</label>
                        <label for="txt-confirmpassword">Confirm Password:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" name="txt-fullname" id="txt-fullname" required>
                        <input type="email" name="txt-email" id="txt-email" required>
                        <input type="text" name="txt-username" id="txt-username" required>
                        <input type="text" name="txt-address" id="txt-address" required>
                        <input type="text" name="txt-phonenumber" id="txt-phonenumber" maxlength="11" required>
                        <input type="password" name="txt-password" id="txt-password" required>
                        <input type="password" name="txt-confirmpassword" id="txt-confirmpassword" required>
                        <input type="submit" name="add-btn" id="add-btn" value="Add Seller">
                    </div>        
            </form>
        </div>
        <div class="table-actions">
        <div class="delete-container">
            <button type="button" class="delete-action" onclick="handleDelete()"><i class="fa-solid fa-trash"><span class="delete"> Delete</span></i></button>
        </div>
        <div class="product-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form method="GET" action="" id="searchForm">
                <input type="search" name="search" placeholder="Search Items..."  value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">                            
            </form>
        </div>
    </div>

    <div class="product-table">
        <form method = 'POST' action='./delete-account.php' id="sellerForm">    
            <table>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Phonenumber</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>

                <?php
                    include('conn.php');
                    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                    $sql = "SELECT 
                        `user_id`, 
                        `user_fullName`, 
                        `user_username`, 
                        `user_password`, 
                        `user_email`, 
                        `user_contactNo`, 
                        `user_address`, 
                        `acc_type` 
                    FROM 
                        `tbusers` 
                    WHERE 
                        `user_fullName` LIKE '%$searchTerm%'
                        OR `user_username` LIKE '%$searchTerm%'
                        OR `user_email` LIKE '%$searchTerm%'
                        OR `user_contactNo` LIKE '%$searchTerm%'
                        OR `user_address` LIKE '%$searchTerm%'
                        OR `acc_type` LIKE '%$searchTerm%'
                    ORDER BY 
                        `user_id`";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td class='check'><input type = 'checkbox' name = 'user_ids[]' value = '".$row['user_id']."'></td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["user_fullName"] . "</td>";
                        echo "<td>" . $row["user_username"] . "</td>";
                        echo "<td>" . $row["user_address"] . "</td>";
                        echo "<td>" . $row["user_contactNo"] . "</td>";
                        echo "<td>" . $row["acc_type"] . "</td>";
                        echo "<td class='actions'>";                                
                        echo '<a href = "./seller.php?id='. $row["user_id"].'">';
                        echo "<i class='fa-solid fa-pen-to-square'></i></a>";                                
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }                                 
                ?>
            </table>
        </form>   
    </div>
    </div>

    <script>
        function handleDelete(){
            let form = document.getElementById("sellerForm");
            let checkboxes = form.querySelectorAll('input[name="user_ids[]"]:checked');

            if (checkboxes.length === 0) {
                alert("Please select at least one seller account to delete.");
            }else{
                if (confirm("Are you sure you want to delete seller account?") == true) { 
                    form.submit();  
                } else {                   
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = false;
                    });      
                    alert("Action Cancelled");
                }
            }
        }

            document.querySelector('input[name="search"]').addEventListener('keydown', (event) =>{
                if(event.keyCode === 13){
                    document.getElementById("searchForm").submit();
                }
            })

    </script>

    

</body>
</html>