<?php
include("../../includes/database_conn.php");
include("../../objects/users.php");


$token = "";
if(isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error = new stdClass();
    $error->message = "No token is specified!";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

$user = new User($pdo);

if($user->isTokenValid($token)) {
    $users = $user->GetAllUsers();
    print_r(json_encode($users));

} else {
    $error = new stdClass();
    $error->message = "Invalid token! Login to create a new token.";
    $error->code = "408";
    print_r(json_encode($error));
}


?>