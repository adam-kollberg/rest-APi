<?php
   include("../../includes/database_conn.php");
   include("../../objects/users.php");


$error = new stdClass();
if(empty($_GET['username'])) {
    $error->message = "No username is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['email'])) {
    $error->message = "No email is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['password'])) {
    $error->message = "No password is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

if(empty($_GET['role'])) {
    $error->message = "No role is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}

    $user = new User($pdo);
    print_r(json_encode($user->createUser($_GET['username'], $_GET['email'], $_GET['password'], $_GET['role'])));

?>