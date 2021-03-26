<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");



$products = new product($pdo);
print_r(json_encode($products->getProducts()));

?>