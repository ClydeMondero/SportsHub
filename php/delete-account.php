<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted
    if (isset($_POST['user_ids']) && is_array($_POST['user_ids'])) {

        // Check if the 'user_ids' array is set and is an array
        $selectedUserIds = $_POST['user_ids'];

        // Check if any selected user is an admin
        $adminCheckQuery = "SELECT COUNT(*) AS admin_count FROM `tbusers` WHERE `user_id` IN (" . implode(',', $selectedUserIds) . ") AND `acc_type` = 'admin'";
        $adminCheckResult = $conn->query($adminCheckQuery);
        $adminCount = $adminCheckResult->fetch_assoc()['admin_count'];

        if ($adminCount > 0) {
            // Display alert using JavaScript
            echo "<script>alert('Admin account/s cannot be deleted');</script>";

            // Redirect using JavaScript after a delay
            echo "<script>setTimeout(function() { window.location.href = 'seller-account.php'; }, 1000);</script>";
            exit();
        }

        // Selected user IDs
        $usersToDelete = implode(',', $selectedUserIds);

        $deleteQuery = "DELETE FROM `tbusers` WHERE `user_id` IN (" . $usersToDelete . ")";
        $conn->query($deleteQuery);
        mysqli_close($conn);

        // Display alert using JavaScript
        echo "<script>alert('Seller Account/s Deleted');</script>";

        // Redirect using JavaScript after a delay
        echo "<script>setTimeout(function() { window.location.href = 'seller-account.php'; }, 1000);</script>";
        exit();
    } else {
        echo ("<script>alert('No Seller Account Selected');</script>");
        // Redirect using JavaScript after a delay
        echo "<script>setTimeout(function() { window.location.href = 'seller-account.php'; }, 1000);</script>";
        exit();
    }
}
?>