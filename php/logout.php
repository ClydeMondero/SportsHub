<?php
session_start();
session_destroy();
echo ("<script>alert('Logout Successful');</script>");
header('Location: index.php');
?>