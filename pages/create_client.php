<?php
include '../classes/Client.php';
include('../views/sidebar.php');

$clientManager = new Client($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            if ($clientManager->createClient($nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $targetFilePath, $telephonePere, $telephoneMere)) {
                $message = '<div class="success-message">Client created successfully.</div>';
            } else {
                $message = '<div class="error-message">Error creating client in the database.</div>';
            }
        } else {
            $message = '<div class="error-message">Error uploading the photo. Please check file permissions.</div>';
        }
    } else {
        $message = '<div class="error-message">File is not a valid image.</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Client</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
    margin-top: 280px;
}

form input[type="text"],
form input[type="email"],
form input[type="date"],
form input[type="file"],
form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="date"]:focus,
form input[type="file"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

form button {
    background-color: green;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

form input[type="file"] {
    border: none;
    padding-left: 0;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}


form button:active {
    transform: scale(0.98);
}

    </style>
</head>
<body>
<div class="main-content">

    <form action="create_client.php" method="POST" enctype="multipart/form-data">
    <h2>Créer Client</h2>
    <?php if (!empty($message)): ?>
            <?php echo $message; ?>
        <?php endif; ?>
        <input type="text" name="nom" placeholder="Nom" required><br>
        <input type="text" name="prenom" placeholder="Prénom" required><br>
        <label for="">Date de Naissance :</label>
        <input type="date" name="DateNaissance" required><br>
        <label for="">Date de creation :</label>
        <input type="date" name="Date" required> 
        <input type="text" name="telephone" placeholder="Téléphone" required><br>
        <input type="text" name="LieuNaissance" placeholder="Lieu de Naissance" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="cin" placeholder="CIN" required><br>
        <label for="">Photo :</label>
        <input type="file" name="photo" required>
        <input type="text" name="TelephonePere" placeholder="Téléphone Père"><br>
        <input type="text" name="TelephoneMere" placeholder="Téléphone Mère"><br>
        <input type="text" name="Adresse" placeholder="Adresse" required><br>
        <button type="submit">Create Client</button>
    </form>
</div>
</body>
</html>
