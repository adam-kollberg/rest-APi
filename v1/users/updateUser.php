<?php

include("../../includes/database_conn.php");
include("../../objects/users.php");

if (empty($_GET['user_id'])) {
    $error = new stdClass();
    $error->message = "No id specified!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['username'])) {
    $error = new stdClass();
    $error->message = "No username is specified!";
    $error->code = "0001";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['email'])) {
    $error = new stdClass();
    $error->message = "No email is specified!";
    $error->code = "0002";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['password'])) {
    $error = new stdClass();
    $error->message = "No password is specified!";
    $error->code = "0003";
    print_r(json_encode($error));
    die();
}

if (empty($_GET['role'])) {
    $error = new stdClass();
    $error->message = "No role specified!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}

$users = new User($pdo);
print_r (json_encode($users->updateUser($_GET['user_id'], $_GET['username'], $_GET['email'] ,$_GET['password'], $_GET['role'])));


?>