<?php
require_once('classes/login.php');  

$login = new Login($conn);
$login->logout();  

header("Location: index.php");
exit();
?>
