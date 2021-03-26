<?php


class User {
private $database_connection;


function __construct($db){
$this->database_connection = $db;

}



function createUser($username, $email, $password, $role) {

$sql = "SELECT * from users WHERE username=:username_IN OR email=:email_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":username_IN", $username);
$stmt->bindParam(":email_IN", $email);
$stmt->execute();


$num_rows = $stmt->rowCount();
if($num_rows > 0) {
    $error = new stdClass();
    $error->message = "user allready regsitred";
    return $error;
    die();
}

if($num_rows == 0) {
    $sql = "INSERT into users (username, email, password, role) VALUES(:username_IN, :email_IN, :password_IN, :role_IN)";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(':username_IN', $username);
    $stmt->bindParam(':email_IN', $email);
    $stmt->bindParam(':password_IN', $password);
    $stmt->bindParam(':role_IN', $role);
    $stmt->execute();
    
    $message = new stdClass();

    if($stmt->execute()) {
      $message->message = "The user is succesfully created";
      $message->userID = $this->database_connection->lastInsertID();
  
    } else {
      $message->message = "Could not add product!";
      $message->code = "0001";
    }
   
    return $message;
  
    }
   
   } 

function getAllUsers() {
$sql = "SELECT username, email, password FROM users";
$stmt = $this->database_connection->prepare($sql);
$stmt->execute();
return $stmt->fetchAll();

}

function getUser($user_id) {
$sql = "SELECT username, email, password FROM users WHERE id=:user_id_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":user_id_IN", $user_id);

if (!$stmt->execute()|| $stmt->rowCount() < 1){
$error = new stdClass();
$error->message = "User does not exist!";
$error->code = "0020";
return $error;
die();

} else {
    return ($stmt->fetch(PDO::FETCH_ASSOC));
}


}

function deleteUser ($user_id) {
$sql = "DELETE FROM users WHERE id=:user_id_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":user_id_IN", $user_id);
$stmt->execute();

$message = new stdClass();
if($stmt->rowCount() > 0) {
$message->message ="user with id=$user_id was removed";
return $message;
}

$message->text = "No user with=$user_id was found";
return $message;


}

function updateUser($user_id, $username = "", $email = "", $password="", $role="") {
$error = new stdClass();
if(!empty($username)) {
    $error->message = $this->UpdateUsername($user_id, $username);
}

if(!empty($email)) {
    $error->message = $this->UpdateEmail($user_id, $email);
}

if(!empty($password)) {
    $error->message = $this->UpdatePassword($user_id, $password);
}


if(!empty($role)) {
    $error->message = $this->UpdateRole($user_id, $role);
}

return $error;

$message = new stdClass();
$message = "The product is succesfully updated";
return $message;

}

private function UpdateUsername($user_id, $username) {
    $sql = "UPDATE users SET username=:username_IN WHERE id=:user_id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":username_IN", $username);
    $stmt->bindParam(":user_id_IN", $user_id);
    $stmt->execute();


    

}

private function UpdateEmail($user_id, $email) {
    $sql = "UPDATE users SET email=:email_IN WHERE id=:user_id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":email_IN", $email);
    $stmt->bindParam(":user_id_IN", $user_id);
    $stmt->execute();

    
}

private function UpdatePassword($user_id, $password) {
    $sql = "UPDATE users SET password=:password_IN WHERE id=:user_id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":password_IN", $password);
    $stmt->bindParam(":user_id_IN", $user_id);
    $stmt->execute();

    
 


}

private function UpdateRole($user_id, $role) {
    $sql = "UPDATE users SET role=:role_IN WHERE id=:user_id_IN";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":role_IN", $role);
    $stmt->bindParam(":user_id_IN", $user_id);
    $stmt->execute();

   
}


}








?>