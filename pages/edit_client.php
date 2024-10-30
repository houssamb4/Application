<?php
include '../classes/Client.php';
include '../views/sidebar.php';

$clientManager = new Client($conn);

$client = null; 

if (isset($_GET['id'])) {
    $clientId = $_GET['id'];
    $client = $clientManager->getClientById($clientId); 

    if (!$client) {
        echo "Client not found.";
        exit;
    }
} else {
    echo "No client ID provided.";
    exit;
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
                $clientManager->updateClient($client['id'], $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $targetFilePath, $telephonePere, $telephoneMere);
                header('Location: ./list_clients.php');
                exit;
            } else {
                echo "Error uploading the photo.";
            }
        } else {
            echo "File is not a valid image.";
        }
    } else {
        $clientManager->updateClient($client['id'], $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $client['photo'], $telephonePere, $telephoneMere);
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
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.main-content {
    margin-top: 20px;
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

input[type="file"] {
    border: none;
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
    display: none; /* Hidden by default */
}

.container {
    margin: 0 auto; /* Center the container */
    padding: 20px; /* Add some padding */
    background-color: #f9f9f9; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

label {
    display: block; /* Make labels block elements */
    margin-bottom: 5px; /* Space between label and input */
    font-weight: bold; /* Bold label text */
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="file"] {
    width: 100%; /* Full width for inputs */
    padding: 10px; /* Padding for input fields */
    margin-bottom: 15px; /* Space between inputs */
    border: 1px solid #ccc; /* Border around inputs */
    border-radius: 4px; /* Rounded corners */
    box-sizing: border-box; /* Include padding and border in total width */
}

input[type="file"] {
    padding: 5px; /* Padding for file input */
    border: none; /* Remove border */
}

.preview-container {
    display: flex; /* Flexbox for centering the image */
    justify-content: center; /* Center image horizontally */
    margin-bottom: 15px; /* Space below the preview */
}

.preview-image {
    max-width: 100%; /* Responsive image */
    max-height: 200px; /* Set a maximum height */
    border: 1px solid #ccc; /* Border around the image */
    border-radius: 4px; /* Rounded corners */
    display: block; /* Ensure it behaves like a block element */
}


    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>Edit Client</h2>
            <?php if ($client): ?>
                <form action="edit_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">

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
                  <img id="previewImage" src="<?php echo htmlspecialchars($client['photo']); ?>" alt="Image Preview" class="preview-image" style="display: <?php echo $client['photo'] ? 'block' : 'none'; ?>;">
                 </div>


                <button type="submit" name="update_client">Update Client</button>
            </form>
            <?php else: ?>
                <p>No client data available to edit.</p>
            <?php endif; ?>
        </div>
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
                    previewImage.style.display = 'block'; // Show the image
                }

                reader.readAsDataURL(file);
            } else {
                previewImage.src = ''; // Reset the preview
                previewImage.style.display = 'none'; // Hide the image
            }
        });
    });
</script>


</body>
</html>
