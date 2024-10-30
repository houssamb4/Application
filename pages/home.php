<?php 
require '../db.php';
require '../classes/client.php';
$client = new Client($conn);
$totalClients = $client->countClients();
$totalutilisateur = $client->countutilisateur();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Sport Academie</title>
    <link rel="shortcut icon" href="../views/assets/logo.png" type="image/x-icon">

    
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
            <p><?php echo $totalClients;?></p>
        </div>
        <div class="stat-box">
            <h2>Active Subscriptions</h2>
            <p>0</p>
        </div>
        <div class="stat-box">
            <h2>Utilisateur</h2>
            <p><?php echo $totalutilisateur;?></p>
        </div>
    </div>

    <div class="recent-activities">
    <h2>Activités Récentes</h2>
    <ul>
        <?php
        $query = "SELECT user_id, client_id, activity_description FROM activities ORDER BY activity_date DESC LIMIT 5";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['user_id']) . " - " . htmlspecialchars($row['activity_description']) . "</li>";
            }
        } else {
            echo "<li>Aucune activité récente</li>";
        }
        ?>
    </ul>
</div>



    <div class="action-buttons">
        <button onclick="window.location.href='create-client.php'">Ajouter un Client</button>
        <button onclick="window.location.href=''">Creer un recu</button>
        <button onclick="window.location.href=''">Manage Subscriptions</button>
    </div>

    </div>
</body>
</html>
