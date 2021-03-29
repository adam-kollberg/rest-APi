<?php 
include("../../includes/database_conn.php");
include("../../objects/cart.php");


$error = new stdClass();
if(empty($_GET['token'])) {
    $error->message = "No token is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}



$error = new stdClass();
if(empty($_GET['product_id'])) {
    $error->message = "no product is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['quantity'])) {
    $error->message = "No quantity is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}



$cart = new Cart($pdo);



if ($cart->isTokenValid($_GET['token'])){
    $cartItems = $cart->addProductToCart($_GET['token'],$_GET['quantity'],$_GET['product_id'], $_GET['quantity'] );
    print_r(json_encode($cartItems));
} else {
    $error = new stdClass();
    $error->message = "Your cart is invalid, please log in again";
    $error->code = "408";
    print_r(json_encode($error));

//print_r(json_encode($cart->addProductToCart($_GET['token'], $_GET['quantity'], $_GET['product_id'], $_GET['quantity'])));
}
?>