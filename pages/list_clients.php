<?php
include('../views/sidebar.php');
include('../config/database.php'); // Assurez-vous que le fichier de connexion à la base de données est inclus

// Récupérer les clients
$sql = "SELECT id, nom, prenom, DateNaissance, Date, telephone, LieuNaissance, email, cin, photo, TelephonePere, TelephoneMere, Adresse FROM Client";
$result = $conn->query($sql);

// Traitement de l'ajout, modification et suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajout d'un nouveau client
    if (isset($_POST['add'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $DateNaissance = $_POST['DateNaissance'];
        $Date = $_POST['Date'];
        $telephone = $_POST['telephone'];
        $LieuNaissance = $_POST['LieuNaissance'];
        $email = $_POST['email'];
        $cin = $_POST['cin'];
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$photo"); // Déplacez la photo dans le dossier uploads
        $TelephonePere = $_POST['TelephonePere'];
        $TelephoneMere = $_POST['TelephoneMere'];
        $Adresse = $_POST['Adresse'];

        $insert_sql = "INSERT INTO Client (nom, prenom, DateNaissance, Date, telephone, LieuNaissance, email, cin, photo, TelephonePere, TelephoneMere, Adresse) 
                       VALUES ('$nom', '$prenom', '$DateNaissance', '$Date', '$telephone', '$LieuNaissance', '$email', '$cin', '$photo', '$TelephonePere', '$TelephoneMere', '$Adresse')";
        $conn->query($insert_sql);
    }
    // Suppression d'un client
    elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $delete_sql = "DELETE FROM Client WHERE id = $id";
        $conn->query($delete_sql);
    }
    // Modification d'un client
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $DateNaissance = $_POST['DateNaissance'];
        $Date = $_POST['Date'];
        $telephone = $_POST['telephone'];
        $LieuNaissance = $_POST['LieuNaissance'];
        $email = $_POST['email'];
        $cin = $_POST['cin'];
        $photo = $_FILES['photo']['name'];
        
        // Si une nouvelle photo est téléchargée
        if ($photo) {
            move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$photo");
            $update_sql = "UPDATE Client SET nom='$nom', prenom='$prenom', DateNaissance='$DateNaissance', Date='$Date', telephone='$telephone', 
                           LieuNaissance='$LieuNaissance', email='$email', cin='$cin', photo='$photo' WHERE id = $id";
        } else {
            $update_sql = "UPDATE Client SET nom='$nom', prenom='$prenom', DateNaissance='$DateNaissance', Date='$Date', telephone='$telephone', 
                           LieuNaissance='$LieuNaissance', email='$email', cin='$cin' WHERE id = $id";
        }
        $conn->query($update_sql);
    }
}

// Ferme la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients - Sport Academie</title>
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

        .form-container {
            margin: 20px 0;
        }

        .form-container input,
        .form-container select {
            margin: 5px;
            padding: 10px;
            width: 200px;
        }

        .form-container textarea {
            margin: 5px;
            padding: 10px;
            width: 200px;
            height: 60px;
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
                                    <form method="POST" enctype="multipart/form-data" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="text" name="nom" placeholder="Nom" value="<?php echo $row['nom']; ?>" required>
                                        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $row['prenom']; ?>" required>
                                        <input type="date" name="DateNaissance" value="<?php echo $row['DateNaissance']; ?>" required>
                                        <input type="date" name="Date" value="<?php echo $row['Date']; ?>" required>
                                        <input type="text" name="telephone" placeholder="Téléphone" value="<?php echo $row['telephone']; ?>" required>
                                        <input type="text" name="LieuNaissance" placeholder="Lieu de Naissance" value="<?php echo $row['LieuNaissance']; ?>" required>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                                        <input type="text" name="cin" placeholder="CIN" value="<?php echo $row['cin']; ?>" required>
                                        <input type="file" name="photo">
                                        <input type="submit" name="update" value="Modifier">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun client trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
