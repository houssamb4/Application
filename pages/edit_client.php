<?php
include '../classes/Client.php';
require_once('../db.php'); 

$clientManager = new Client($conn);

if (!isset($_GET['id'])) {
    echo "No client ID provided.";
    exit;
}

$clientId = $_GET['id'];
$client = $clientManager->getClientById($clientId);

if (!$client) {
    echo "Client not found.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_client'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $dateNaissance = htmlspecialchars($_POST['DateNaissance']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $lieuNaissance = htmlspecialchars($_POST['LieuNaissance']);
    $email = htmlspecialchars($_POST['email']);
    $cin = htmlspecialchars($_POST['cin']);
    $Adresse = htmlspecialchars($_POST['Adresse']);
    $telephonePere = htmlspecialchars($_POST['TelephonePere'] ?? '');
    $telephoneMere = htmlspecialchars($_POST['TelephoneMere'] ?? '');

    $targetDir = "images/";
    $photoPath = $client['photo']; 

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $photoName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                $photoPath = $targetFilePath; // Update path if upload is successful
            } else {
                echo "Error uploading the photo.";
                exit;
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG & GIF are allowed.";
            exit;
        }
    }

    $clientManager->updateClient($client['id'], $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $photoPath, $telephonePere, $telephoneMere);
    header('Location: ./list_clients.php?message=client_updated');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="file"],
        button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .preview-container {
            margin-top: 15px;
            text-align: center;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Client</h2>
        <?php if ($client): ?>
            <form action="edit_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" method="POST" enctype="multipart/form-data">
                <label>Nom:</label>
                <input type="text" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>

                <label>Prénom:</label>
                <input type="text" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" required>

                <label>Date de Naissance:</label>
                <input type="date" name="DateNaissance" value="<?php echo htmlspecialchars($client['DateNaissance']); ?>" required>

                <label>Téléphone:</label>
                <input type="text" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>

                <label>CIN:</label>
                <input type="text" name="cin" value="<?php echo htmlspecialchars($client['cin']); ?>" required>

                <label>Lieu de Naissance:</label>
                <input type="text" name="LieuNaissance" value="<?php echo htmlspecialchars($client['LieuNaissance']); ?>" required>

                <label>Téléphone Père:</label>
                <input type="text" name="TelephonePere" value="<?php echo htmlspecialchars($client['TelephonePere']); ?>">

                <label>Téléphone Mère:</label>
                <input type="text" name="TelephoneMere" value="<?php echo htmlspecialchars($client['TelephoneMere']); ?>">

                <label>Adresse:</label>
                <input type="text" name="Adresse" value="<?php echo htmlspecialchars($client['Adresse']); ?>" required>

                <label>Photo:</label>
                <input type="file" name="photo" accept="image/*" id="photoInput">
                <div class="preview-container">
                    <img id="previewImage" src="<?php echo htmlspecialchars($client['photo']); ?>" alt="Image Preview" class="preview-image">
                </div>

                <button type="submit" name="update_client">Update Client</button>
            </form>
        <?php else: ?>
            <p>No client data available to edit.</p>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const photoInput = document.getElementById('photoInput');
        const previewImage = document.getElementById('previewImage');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
    </script>
</body>
</html>
