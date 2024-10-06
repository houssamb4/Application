<?php
require_once('classes/login.php');  

$login = new Login($conn);
$login->logout();  

header("Location: login.php");
exit();
?>
