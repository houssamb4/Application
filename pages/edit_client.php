<?php
include '../classes/Client.php';
include '../views/sidebar.php';

$clientManager = new Client($conn);

if (isset($_POST['client_id'])) {
    $clientId = $_POST['client_id'];
    echo "Client ID: " . htmlspecialchars($clientId) . "<br>"; 
    $client = $clientManager->getClientById($clientId); 

    if (!$client) {
        echo "Client not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_client'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['DateNaissance'];
    $telephone = $_POST['telephone'];
    $lieuNaissance = $_POST['LieuNaissance'];
    $email = $_POST['email'];
    $cin = $_POST['cin'];
    $Adresse = $_POST['Adresse'];
    $telephonePere = $_POST['TelephonePere'] ?? null;
    $telephoneMere = $_POST['TelephoneMere'] ?? null;

    $targetDir = "images/";
    $photoName = basename($_FILES['photo']['name']);
    $targetFilePath = $targetDir . $photoName;

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                $clientManager->updateClient($clientId, $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $targetFilePath, $telephonePere, $telephoneMere);
                header('Location: ./list_clients.php'); 
                exit;
            } else {
                echo "Error uploading the photo.";
            }
        } else {
            echo "File is not a valid image.";
        }
    } else {
        $clientManager->updateClient($clientId, $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $client['photo'], $telephonePere, $telephoneMere);
        header('Location: ./list_clients.php'); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <style>
        .container {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Client</h2>
        <form action="edit_client.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($client['id']); ?>">

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
            <input type="file" name="photo" accept="image/*">

            <button type="submit" name="update_client">Update Client</button>
        </form>
    </div>
</body>
</html>
