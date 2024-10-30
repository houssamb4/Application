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
            padding: 1px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
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
            <h1>Liste des Clients</h1>

            <div class="form-container">
                <h2>Ajouter un Client</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="date" name="DateNaissance" required>
                    <input type="date" name="Date" required>
                    <input type="text" name="telephone" placeholder="Téléphone" required>
                    <input type="text" name="LieuNaissance" placeholder="Lieu de Naissance" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="cin" placeholder="CIN" required>
                    <input type="file" name="photo" required>
                    <input type="text" name="TelephonePere" placeholder="Téléphone Père">
                    <input type="text" name="TelephoneMere" placeholder="Téléphone Mère">
                    <textarea name="Adresse" placeholder="Adresse"></textarea>
                    <input type="submit" name="add" value="Ajouter">
                </form>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de Naissance</th>
                            <th>Date</th>
                            <th>Téléphone</th>
                            <th>Lieu de Naissance</th>
                            <th>Email</th>
                            <th>CIN</th>
                            <th>Photo</th>
                            <th>Téléphone Père</th>
                            <th>Téléphone Mère</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nom']; ?></td>
                                <td><?php echo $row['prenom']; ?></td>
                                <td><?php echo $row['DateNaissance']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['telephone']; ?></td>
                                <td><?php echo $row['LieuNaissance']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['cin']; ?></td>
                                <td><img src="../uploads/<?php echo $row['photo']; ?>" alt="photo" width="50"></td>
                                <td><?php echo $row['TelephonePere']; ?></td>
                                <td><?php echo $row['TelephoneMere']; ?></td>
                                <td><?php echo $row['Adresse']; ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="submit" name="delete" value="Supprimer">
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="text" name="nom" placeholder="Nom" value="<?php echo $row['nom']; ?>" required>
                                        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $row['prenom']; ?>" required>
                                        <input type="date" name="DateNaissance" value="<?php echo $row['DateNaissance']; ?>" required>
                                        <input type="date" name="Date" value="<?php echo $row['Date']; ?>" required>
                                        <input type="text" name="telephone" placeholder="Téléphone" value="<?php echo $row['telephone']; ?>" required>
                                        <input type="text" name="LieuNaissance" placeholder="Lieu de Naissance" value="<?php echo $row['LieuNaissance']; ?>" required>
                                        <input type="email" name="email" placeholder="Email"
