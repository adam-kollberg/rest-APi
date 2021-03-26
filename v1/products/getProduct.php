<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");


if(empty($_GET['id'])) {
    $error = new stdClass();
    $error->message = "No id specified!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}

$products = new product($pdo);
echo json_encode($products->getProduct($_GET['id']));

?>