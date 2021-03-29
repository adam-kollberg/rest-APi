<?php
include("../../includes/database_conn.php");
include("../../objects/users.php");

if (empty($_GET['user_id'])) {
            $error = new stdClass();
            $error->message = "No id is specified!";
            $error->code = "404";
            print_r(json_encode($error));
            die();
}
        
        $users = new User($pdo);
        
       print_r (json_encode($users->deleteUser($_GET['user_id'])));

    ?>