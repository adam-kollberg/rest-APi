<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");

if (empty($_GET['id'])) {
    $error = new stdClass();
    $error->message = "No id specified!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['title'])) {
    $error = new stdClass();
    $error->message = "No title specified!";
    $error->code = "0001";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['description'])) {
    $error = new stdClass();
    $error->message = "No description specified!";
    $error->code = "0002";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['price'])) {
    $error = new stdClass();
    $error->message = "No price specified!";
    $error->code = "0003";
    print_r(json_encode($error));
    die();
}

$product = new product($pdo);
print_r (json_encode($product->updateProduct($_GET['id'], $_GET['title'], $_GET['description'], $_GET['price'])));


?>