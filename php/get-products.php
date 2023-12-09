<?php 
    include "conn.php";

    $search = "SELECT * FROM tbproducts WHERE product_name LIKE '%".$_POST["search_term"]."%' OR product_category LIKE '%".$_POST["search_term"]."%' OR product_sport LIKE '%".$_POST["search_term"]."%' OR product_brand LIKE '%".$_POST["search_term"]."%'";

$results = $conn->query($search);

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