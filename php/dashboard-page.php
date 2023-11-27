<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard-page.css">
    <title>Document</title>
</head>
<body>
    <div class="admin">
        <?php
            include("../php/dashboard.php");
        ?>
        <div class="admin-container">
                <span>ADMIN PAGE</span>
            <div class="first-row-container">
                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-coins"></i>
                    <h1>2,196</h1>
                    </div>
                    <p>Sales</p>
                </div>

                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-cubes-stacked"></i>
                    <h1>98</h1>
                    </div>
                    <p>Categories</p>
                </div>

                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-users"></i>
                    <h1>26</h1>
                    </div>
                    <p>Users</p>
                </div>
            </div>
            <div class="second-row-container">
                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-box-open"></i>
                    <h1>5,500</h1>
                    </div>
                    <p>Products</p>
                </div>

                <div class="rows">
                    <div class="rows-content">
                    <i class="fa-solid fa-layer-group"></i>
                    <h1>8,196</h1>
                    </div>
                    <p>Available Stocks</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>