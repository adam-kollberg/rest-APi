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

$product = new product($pdo);

echo json_encode($product->deleteProduct($_GET['id']));
?>