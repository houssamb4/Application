<?php
include('../views/sidebar.php');
include('../config/database.php'); // Assurez-vous que le fichier de connexion à la base de données est inclus

// Récupérer la liste des admins
$sql = "SELECT id, first_name, last_name, email, role, created_at FROM users";
$result = $conn->query($sql);

// Ferme la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Admin - Sport Academie</title>
    <link rel="shortcut icon" href="./assets/logo.jpg" type="image/x-icon">

    <style>
        <?php echo file_get_contents('../assets/main.css'); ?>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <script>
        // Fonction JavaScript pour confirmer la suppression
        function confirmDelete(userId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?")) {
                window.location.href = "delete_user.php?id=" + userId;
            }
        }
    </script>
</head>

<body>

    <div class="main-content">
        <div class="container">
            <h1>Liste des admins</h1>

            <a href="add_user.php">Ajouter un nouvel admin</a> <!-- Redirection vers la page d'ajout -->

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <!-- Lien pour modifier l'utilisateur -->
                                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Modifier</a>

                                    <!-- Bouton pour supprimer l'utilisateur avec confirmation -->
                                    <button onclick="confirmDelete(<?php echo $row['id']; ?>)">Supprimer</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun admin trouvé.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
