<?php
require_once('db.php'); 
require_once('./classes/login.php'); 

$login = new Login($conn); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $login->authenticateUser($email, $password);

    if ($result === true) {
        header("Location: ./pages/home.php");
        exit();
    } else {
        echo $result;
    }
}

include('./views/login.php');
?>
