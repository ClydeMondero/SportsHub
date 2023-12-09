<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <link rel="stylesheet" href="../styles/dashboard-page.css">
    <title>Vulcan - Dashboard Page</title>
</head>
<body>
    <div class="admin">
        <?php
            include("../php/dashboard.php");?>

        <?php
        include "conn.php";
        $countSales = "SELECT COUNT(1) FROM `tborders` WHERE `order_status`= 'Delivered';";
        $numOfSales = $conn->query($countSales)->fetch_row()[0];

        $countUsers = "SELECT COUNT(1) FROM `tbusers`;";        
        $numOfUsers = $conn->query($countUsers)->fetch_row()[0];

        $countProducts = "SELECT COUNT(1) FROM `tbproducts`;";        
        $numOfProducts = $conn->query($countProducts)->fetch_row()[0];

        $countStocks = "SELECT SUM(product_stocks) as total_stocks FROM `tbproducts`;";
        $numOfStocks = $conn->query($countStocks)->fetch_row()[0];    
        
        ?>
        <div class="admin-container">
            <span>SELLER PAGE</span>
            <div class="first-row-container">
                <div class="rows">
                    <div class="rows-content">
                        <i class="fa-solid fa-coins"></i>
                        <h1><?php echo $numOfSales ?></h1>                      
                    </div>                   
                    <p>Sales</p>
                </div>               

                <div class="rows">
                    <div class="rows-content">
                        <i class="fa-solid fa-users"></i>
                        <h1><?php echo $numOfUsers ?></h1>
                    </div>
                    <p>Users</p>
                </div>
            </div>
            <div class="second-row-container">
                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-box-open"></i>
                    <h1><?php echo $numOfProducts ?></h1>
                    </div>
                    <p>Products</p>
                </div>

                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-layer-group"></i>
                    <h1><?php echo $numOfStocks ?></h1>
                    </div>
                    <p>Available Stocks</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>