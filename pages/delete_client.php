<?php
include '../classes/Client.php';
require_once('../db.php'); 

$clientManager = new Client($conn);
$client_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

if (!$client_id) {
    header("Location: list_clients.php");
    exit();
}

$client = $clientManager->getClientById($client_id); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        $clientManager->deleteClient($client_id);
        header("Location: list_clients.php?message=client_deleted");
        exit();
    } else {
        header("Location: list_clients.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer le client</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            height: 100vh;
            color: #333;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #dc3545;
            margin-bottom: 15px;
        }

        .client-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .client-info p strong {
            color: #555;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="container">
        <div class="client-info">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($client['id']); ?></p>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($client['nom']); ?></p>
            <p><strong>Prénom:</strong> <?php echo htmlspecialchars($client['prenom']); ?></p>
        </div>
        <h2>Êtes-vous sûr de vouloir supprimer ce client ?</h2>
        <form method="post" class="button-group">
            <button type="submit" name="confirm" class="btn btn-delete">Supprimer</button>
            <a href="list_clients.php" class="btn btn-cancel">Annuler</a>
        </form>
    </div>
</div>
</body>
</html>
