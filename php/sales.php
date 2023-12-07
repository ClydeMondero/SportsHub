<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/sales.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/Vulcan Logo.png">
    <title>Vulcan - Sales</title>
</head>
<body>
<div class="sale-container">
        <?php include("../php/dashboard.php"); ?>
        <div class="container">
                <h1 class="title">Sales</h1>
             <div class="table-actions">
                    <div class="product-search">  
                        <select name="filter" id="filter">
                            <option value="returned">Returned</option>
                            <option value="returned">Delivered</option>
                            <option value="returned">In Transit</option>
                        </select>                      
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <form method="GET" action="" id="searchForm">
                            <input type="search" name="search" placeholder="Search Items..."  value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">                            
                        </form>
                    </div>                   
                </div>
                <!--Table-->
                <div class="product-table">
                    <table>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Username</th>
                            <th>Order Date</th>
                            <th>Order Arrived Date</th>
                            <th>Order Status</th>
                        </tr>
                        <tr>
                            <td>92</td>
                            <td>Gulaman</td>
                            <td>danricksam</td>
                            <td>06-21-2003</td>
                            <td>06-26-2003</td>
                            <td>Delivered</td>
                        </tr>
                    </table>
                </div>
            </div>
    </div>  
</body>
</html>