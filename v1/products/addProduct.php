<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");


$error = new stdClass();
if(empty($_GET['title'])) {
    $error->message = "No Title is specified";
    $error->code = "0002";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['description'])) {
    $error->message = "No description is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

if(empty($_GET['price'])) {
    $error->message = "No price is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

$product = new product($pdo);
print_r(json_encode($product->addProducts($_GET['title'], $_GET['description'], $_GET['price'])));

?>