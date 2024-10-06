<?php
require_once('classes/login.php');  
require_once('db.php');

$login = new Login($conn);

if (!$login->isLoggedIn()) {
    header("Location: index.php");  
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Sport Academie</title>
    <link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['first_name']; ?>!</h1>
    <p>This is the dashboard page.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
