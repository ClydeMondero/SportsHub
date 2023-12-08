<?php 
    include "conn.php";

    $search = "select * from tbproducts where product_name like '%".$_POST["product_name"]."%'";

    $results = $conn->query($search);

    if(isset($results) && $results->num_rows > 0){
        foreach($results as $result){
            echo "<br>";
            echo '<a href = "./product-page.php?id='. $result["product_id"].'">';        
            echo "<div class='searched-product'><img src=../products/".$result["product_image"].">".$result["product_name"]."</div>";        
            echo "</a>";
        }
    }else{
        echo "<div class='searched-product'>No products found.</div>";
    }   
?>