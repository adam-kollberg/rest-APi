<?php
include("../../includes/database_conn.php");
include("../../objects/products.php");

if (empty($_GET['id'])) {
    $error = new stdClass();
    $error->message = "No id is specified!";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['title'])) {
    $error = new stdClass();
    $error->message = "No title is specified!";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['description'])) {
    $error = new stdClass();
    $error->message = "No description is specified!";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['price'])) {
    $error = new stdClass();
    $error->message = "No price is specified!";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

$product = new product($pdo);
print_r (json_encode($product->updateProduct($_GET['id'], $_GET['title'], $_GET['description'], $_GET['price'])));


?>