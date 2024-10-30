<?php
require_once('db.php');  
require_once('./classes/registration.php');  

$registration = new Registration($conn);  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $result = $registration->registerUser($first_name, $last_name, $email, $role, $password, $confirm_password);

    if ($result === true) {
        header("Location: ./views/account_created.php");
        exit();
    } else {
        echo $result;
    }
}

include('./views/register.php');
?>
