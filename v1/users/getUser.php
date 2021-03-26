<?php
include("../../includes/database_conn.php");
include("../../objects/users.php");



if(empty($_GET['user_id'])) {
    $error = new stdClass();
    $error->message = "No id specified!";
    $error->code = "0004";
    print_r(json_encode($error));
    die();
}



$users = new User($pdo);



print_r(json_encode($users->getUser($_GET['user_id'])));

?>