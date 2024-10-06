<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Sport Academie</title>
    <link rel="shortcut icon" href="../views/assets/logo.jpg" type="image/x-icon">

    
    <style>
        <?php echo file_get_contents('./assets/style.css'); ?>
    </style>
</head>

<body>
    <?php include('../views/sidebar.php'); ?>

    <div class="main-content">
        <h1>Bienvenue, <?php echo $_SESSION['first_name']; ?>!</h1>
        <p>Ceci est la page du tableau de bord.</p>
    </div>
</body>
</html>
