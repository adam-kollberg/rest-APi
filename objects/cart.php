<?php 

class Cart {

    private $database_connection;

function __construct($db){
    $this->database_connection = $db;
  }

function addProductToCart($loggedInToken, $product_id, $quantity) {

$sql = "SELECT id FROM sessions WHERE token=:logged_in_token_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam("logged_in_token_IN", $loggedInToken);
$stmt->execute();
$row = $stmt->fetch();
$cart_token=$row['id'];

$sql= "INSERT INTO cart (product_id, quantity, cart_session_id) VALUES(:product_id_IN, :quantity_IN, :cart_session_IN)";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":product_id_IN", $product_id);
$stmt->bindParam(":quantity_IN", $quantity);
$stmt->bindParam(":cart_session_IN", $cart_token);
$stmt->execute();
    
$message = new stdClass();
$message->message="The items has been added to cart";
$message->code="200";
return $message;


$this->isTokenValid($loggedInToken);



}


function isTokenValid($loggedInToken) {
    $sql= "SELECT token, last_used FROM sessions WHERE token=:token_IN AND last_used > :active_time_IN LIMIT 1";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":token_IN", $loggedInToken);
    $active_time = time() - (60*60);
    $stmt->bindParam(":active_time_IN", $active_time);
    $stmt->execute();
    
    $return = $stmt->fetch();
    
    if(isset($return['token'])) {
    $this->updateToken($return['token']);
    return true;
    } else {
    return false;
    }
    
     }

     function updateToken($token) {
    $sql = "UPDATE sessions SET last_used=:last_used_IN WHERE token=:token_IN";
    $stmt = $this->database_connection->prepare($sql);
    $time = time();
    $stmt->bindParam(":last_used_IN", $time);
    $stmt->bindParam(":token_IN", $token);
    $stmt->execute();

}





function deleteProductsFromCart ($cart_session) {
$sql= "DELETE from cart WHERE cart_session_id=:cart_session_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":cart_session_IN", $cart_session);
$stmt->execute();
    
    
$message = new stdClass();
$message->message="The cart item is succesfully deleted";
$message->code = "200";
return $message;



  }




}