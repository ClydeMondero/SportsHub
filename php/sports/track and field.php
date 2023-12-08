<?php
    include("conn.php");
    
    $select_query = 'select `product_id`, `product_name`, `product_category`, `product_sport`, `product_image`,`product_price` from `tbproducts` where product_sport = "Track and Field" and product_stocks != 0';
    $query_result = $conn->query($select_query);

    foreach ($query_result as $row) {
        $image = $row["product_image"];
        $name = $row["product_name"];
        $category = $row["product_category"];
        $sport = $row["product_sport"];
        $price = $row["product_price"];
        
        
        echo '<div class="product">';
        echo '<a href = "./product-page.php?id='. $row["product_id"].'">';        
        echo '<img src="../products/' . $image . '" alt="' . $row['product_name'] . '">';
        echo '<div class="product-details">';
        echo '<p class="product-name">'.$name.'</p>';
        echo '</a>';
        echo '<p class="product-tags">'.$category.'</p>';
        echo '<p class="product-tags">'.$sport.'</p>';
        echo '<p>₱'.number_format($price, 2).'</p>';
        echo '</div>';
        echo '</div>';
    }

?>

<style><?php include "../styles/product.css"; ?></style>