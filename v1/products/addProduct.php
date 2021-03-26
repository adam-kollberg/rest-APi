<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");


$error = new stdClass();
if(empty($_GET['title'])) {
    $error->message = "A product needs a title!";
    $error->code = "0002";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['description'])) {
    $error->message = "A product needs a description!";
    $error->code = "0003";
    print_r(json_encode($error));
    die();
}

if(empty($_GET['price'])) {
    $error->message = "A product needs a price!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}

$product = new product($pdo);
print_r(json_encode($product->addProducts($_GET['title'], $_GET['description'], $_GET['price'])));

?>