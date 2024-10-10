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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
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
                    <th>Date de Naissance</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>CIN</th>
                    <th>Lieu de Naissance</th>
                    <th>Téléphone Père</th>
                    <th>Téléphone Mère</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clients) > 0): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['id']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($client['photo']); ?>" width="50" height="50" alt="Client Photo"></td>
                            <td><?php echo htmlspecialchars($client['nom']); ?></td>
                            <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($client['DateNaissance']); ?></td>
                            <td><?php echo htmlspecialchars($client['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($client['email']); ?></td>
                            <td><?php echo htmlspecialchars($client['cin']); ?></td>
                            <td><?php echo htmlspecialchars($client['LieuNaissance']); ?></td>
                            <td><?php echo htmlspecialchars($client['TelephonePere']); ?></td>
                            <td><?php echo htmlspecialchars($client['TelephoneMere']); ?></td>
                            <td><?php echo htmlspecialchars($client['Adresse']); ?></td>
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
