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
    $error->message = "user allready registred";
    $error->code = "409";
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
      $message->code = 201;
      $message->userID = $this->database_connection->lastInsertID();
  
    } else {
      $message->message = "Could not add product!";
      $message->code = "500";
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
$stmt->bindParam(":user_id_IN", $user_id);

if (!$stmt->execute()|| $stmt->rowCount() < 1){
$error = new stdClass();
$error->message = "User does not exist!";
$error->code = "404";
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
$message->code="200";
return $message;
}

$message->text = "No user with=$user_id was found";
$message->code="404";
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



$message = new stdClass();
$message->message = "The user is succesfully updated";
$message->code="200";
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


function Login ($username, $password) {
$sql= "SELECT id, username, email, role FROM users WHERE username=:username_IN and password=:password_IN";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":username_IN", $username);
$stmt->bindParam(":password_IN", $password);

$stmt->execute();

if ($stmt->rowCount() == 1) {
$row=$stmt->fetch();
return $this->createToken($row['id'], $row['username']);

  }

 }

function createToken($id, $username) {
 $checked_token = $this->checkToken($id);
 
 if ($checked_token !=false) {
     return $checked_token;
 }

 $token = md5(time()) . $id . $username;


 $sql = "INSERT INTO sessions (user_id, token, last_used) VALUES (:user_id_IN, :token_IN, :last_used_IN)";
 $stmt = $this->database_connection->prepare($sql);
 $stmt->bindParam("user_id_IN", $id);
 $stmt->bindParam("token_IN", $token);
 $time = time();
 $stmt->bindParam("last_used_IN", $time);

 $stmt->execute();
 $message = new stdClass();
 $message->message = "You succesfully logged in here is your token: $token";
 $message->code = "200";
 return $message;
}

function checkToken($id) {
$sql= "SELECT token, last_used FROM sessions WHERE user_id=:user_id_IN AND last_used > :active_time_IN LIMIT 1";
$stmt = $this->database_connection->prepare($sql);
$stmt->bindParam(":user_id_IN", $id);
$active_time = time() - (60*60);
$stmt->bindParam(":active_time_IN", $active_time);

$stmt->execute();

$return = $stmt->fetch();

if(isset($return['token'])) {
 return $return['token'];
} else {
return false;

  }

 }


 function isTokenValid($token) {
    $sql= "SELECT token, last_used FROM sessions WHERE token=:token_IN AND last_used > :active_time_IN LIMIT 1";
    $stmt = $this->database_connection->prepare($sql);
    $stmt->bindParam(":token_IN", $token);
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
    


}








?>