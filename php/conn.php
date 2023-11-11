<?php
try {
    $conn = new mysqli("localhost", "root", "", "dbsportshub");
} catch (Exception $e) {
    echo $e;
}

