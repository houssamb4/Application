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

    <div class="stats-overview">
        <div class="stat-box">
            <h2>Total Clients</h2>
            <p>150</p>
        </div>
        <div class="stat-box">
            <h2>Active Subscriptions</h2>
            <p>120</p>
        </div>
        <div class="stat-box">
            <h2>Pending Bills</h2>
            <p>30</p>
        </div>
    </div>

    <div class="recent-activities">
        <h2>Recent Activities</h2>
        <ul>
            <li>John Doe subscribed for a 6-month membership</li>
            <li>Mary Jane paid her bill</li>
            <li>Michael Smith updated his subscription plan</li>
        </ul>
    </div>

    <div class="action-buttons">
        <button onclick="window.location.href='create-client.php'">Ajouter un Client</button>
        <button onclick="window.location.href=''">Creer un recu</button>
        <button onclick="window.location.href='manage-subscriptions.php'">Manage Subscriptions</button>
    </div>

    </div>
</body>
</html>
