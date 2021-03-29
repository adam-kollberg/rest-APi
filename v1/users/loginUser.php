<?php
   include("../../includes/database_conn.php");
   include("../../objects/users.php");

   $error = new stdClass();
   if(empty($_GET['username'])) {
       $error->message = "No username is specified";
       $error->code = "404";
       print_r(json_encode($error));
       die();
   };


   if(empty($_GET['password'])) {
    $error->message = "No password is specified";
    $error->code = "404";
    print_r(json_encode($error));
    die();
}
    

    $user = new User($pdo);
    $return = new stdClass();
    $return->token = $user->Login($_GET['username'], $_GET['password']);
    print_r(json_encode($return));