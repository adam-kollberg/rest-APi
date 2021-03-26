<?php
   include("../../includes/database_conn.php");
   include("../../objects/users.php");


$error = new stdClass();
if(empty($_GET['username'])) {
    $error->message = "A user needs a username";
    $error->code = "0010";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['email'])) {
    $error->message = "A user needs a email addres";
    $error->code = "0011";
    print_r(json_encode($error));
    die();
}


if(empty($_GET['password'])) {
    $error->message = "A User needs a password!";
    $error->code = "0013";
    print_r(json_encode($error));
    die();
}

if(empty($_GET['role'])) {
    $error->message = "A User needs a role";
    $error->code = "0014";
    print_r(json_encode($error));
    die();
}

    $user = new User($pdo);
    print_r(json_encode($user->createUser($_GET['username'], $_GET['email'], $_GET['password'], $_GET['role'])));

?>