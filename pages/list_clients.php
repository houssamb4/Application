<?php
include '../classes/Client.php';
include('../views/sidebar.php');

$clientManager = new Client($conn);
$clients = $clientManager->listClients();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #333;
        }

        .container{
            margin-right: 200px
        }



        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td img {
            border-radius: 50%;
        }

        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            table th, table td {
                font-size: 12px;
            }

            h2 {
                font-size: 18px;
            }
        }

        .view-button, .edit-button, .delete-button {
    padding: 8px 12px;
    margin: 0 5px;
    text-decoration: none;
    color: white;
    border-radius: 4px;
    font-weight: bold;
    font-size: 14px;
}

.view-button {
    background-color: #007bff;
}

.edit-button {
    background-color: #28a745;
}

.delete-button {
    background-color: #dc3545;
}

.view-button:hover, .edit-button:hover, .delete-button:hover {
    opacity: 0.9;
    cursor: pointer;
}

    </style>
</head>
<body>
<div class="main-content">
    <div class="container">
        <h2>List of Clients</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php if (count($clients) > 0): ?>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?php echo htmlspecialchars($client['id'] ?? 'N/A'); ?></td>
                <td>
                    <?php 
                        $imagePath = !empty($client['photo']) && file_exists($client['photo']) 
                                     ? htmlspecialchars($client['photo']) 
                                     : './images/default_client.png'; 
                    ?>
                    <img src="<?php echo $imagePath; ?>" width="50" height="50" alt="Client Photo">
                </td>
                <td><?php echo htmlspecialchars($client['nom'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($client['prenom'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($client['telephone'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($client['email'] ?? 'N/A'); ?></td>
                <td>
                   <a href="view_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="view-button">Détails</a>
                   <a href="edit_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="edit-button">Modifier</a>
                    <a href="delete_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="delete-button">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="13">No clients found.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
    </div>
</body>
</html>
