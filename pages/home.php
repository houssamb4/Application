<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Sport Academie</title>
    <link rel="shortcut icon" href="../views/assets/logo.jpg" type="image/x-icon">
</head>
<body>
<?php include('../views/sidebar.php')
?>
<div class="main-content">
    <h1>Welcome, <?php echo $_SESSION['first_name']; ?>!</h1>
    <p>This is the dashboard page.</p>
    <a href="./pages/user-list.php">View All Users</a>
    </div>
</body>
</html>

