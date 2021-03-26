<?php 


class product {

private $database_connection;

function __construct($db){
    $this->database_connection = $db;
  }

  function addProducts($title, $description, $price) {
  $sql = "INSERT INTO products (title, description, price) VALUES(:title_IN, :description_IN, :price_IN)";
  $stmt = $this->database_connection->prepare($sql);
  $stmt->bindParam(":title_IN", $title);
  $stmt->bindParam(":description_IN", $description);
  $stmt->bindParam(":price_IN", $price);
  
  $message = new stdClass();

  if($stmt->execute()){
    $message->message = "The product is succesfully created";
    $message->postID = $this->database_connection->lastInsertID();

  }else {
    $message->message = "Could not add product!";
    $message->code = "0001";
  }
 
  return $message;

  }


  function getProducts(){
  $sql = "SELECT * FROM products";
  $stmt = $this->database_connection->prepare($sql);
  $stmt->execute();
  return ($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getProduct($id) {
$sql = "SELECT * FROM products WHERE id=:id_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":id_IN", $id);

if ($stmt->execute()){
return ($stmt->fetch(PDO::FETCH_ASSOC));
  }

 }

function deleteProduct($id) {
$sql = "DELETE FROM products WHERE id=:id_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":id_IN", $id);
if($stmt->execute()){
$message = new stdClass();
$message->message = "Succesfully deleted post";
return $message;
  } 
 }

function updateProduct($id, $title="", $description="", $price="") {
 
if (!empty($title)) {
$this->updateTitle($id, $title);

 }

 if (!empty($description)) {
    $this->updateDescription($id, $description);
    
 }

 if (!empty($price)) {
    $this->updatePrice($id, $price);
    
     }
    
$message = new stdClass();
$message = "The product is succesfully updated";
return $message;
}
private function updateTitle($id, $title) {
    $sql = "UPDATE products SET title=:title_IN WHERE id=:id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":title_IN", $title);
    $stmt->bindParam(":id_IN", $id);
    $stmt->execute();
   

}

private function updateDescription($id, $description) {
    $sql = "UPDATE products SET description=:description_IN WHERE id=:id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":description_IN", $description);
    $stmt->bindParam(":id_IN", $id);
    $stmt->execute();
     

}


private function updatePrice($id, $price) {
    $sql = "UPDATE products SET price=:price_IN WHERE id=:id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":price_IN", $price);
    $stmt->bindParam(":id_IN", $id);
    $stmt->execute();
      

 }


}


?>