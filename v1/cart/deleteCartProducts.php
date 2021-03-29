<?php 
include("../../includes/database_conn.php");
include("../../objects/cart.php");

$error = new stdClass();
if(empty($_GET['session_id'])) {
    $error->message = "No session id is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}


$cart = new Cart($pdo);
print_r(json_encode($cart->deleteProductsFromCart($_GET['session_id'])));

?>