<?php
include("../../includes/database_conn.php");
include("../../objects/users.php");

$user = new User($pdo);
$users = $user->getAllUsers();
print_r(json_encode($users));

?>