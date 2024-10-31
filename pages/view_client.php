<?php
include '../classes/Client.php';
include('../views/sidebar.php');

if (isset($_GET['id'])) {
    $clientId = $_GET['id'];
    $clientManager = new Client($conn);
    $client = $clientManager->getClientById($clientId); 
} else {
    header("Location: client_list.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center; /* Center the heading */
        }

        .client-details {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Limit width for better layout */
            margin: 20px auto; /* Center the container */
        }

        .client-photo {
            display: block; /* Make image block element */
            margin: 0 auto 20px; /* Center the image and add margin */
            border-radius: 50%; /* Round the photo */
            width: 100px; /* Fixed size for the photo */
            height: 100px; /* Fixed size for the photo */
            object-fit: cover; /* Ensure the image covers the area */
        }

        .client-details p {
            margin: 10px 0; /* Add margin to paragraphs */
        }

        .button {
 display: flex;
 height: 3em;
 width: 100px;
 align-items: center;
 justify-content: center;
 background-color: #eeeeee4b;
 border-radius: 3px;
 letter-spacing: 1px;
 transition: all 0.2s linear;
 cursor: pointer;
 border: none;
 background: #fff;
}

.button > svg {
 margin-right: 5px;
 margin-left: 5px;
 font-size: 20px;
 transition: all 0.4s ease-in;
}

.button:hover > svg {
 font-size: 1.2em;
 transform: translateX(-5px);
}

.button:hover {
 box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
 transform: translateY(-2px);
}

    </style>
</head>
<body>
<div class="main-content">
    <div class="container">
        <div class="client-details">
        <a class="button" href="list_clients.php">
             <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
               <span>Back</span>
               </a> 
            <h2>Client Details</h2>
            <?php if ($client): ?>
                <?php 
                    $imagePath = !empty($client['photo']) && file_exists($client['photo']) 
                                 ? htmlspecialchars($client['photo']) 
                                 : './images/default_client.png'; 
                ?>
                <img src="<?php echo $imagePath; ?>" alt="Client Photo" class="client-photo">
                <p><strong>ID:</strong> <?php echo htmlspecialchars($client['id']); ?></p>
                <p><strong>Nom:</strong> <?php echo htmlspecialchars($client['nom']); ?></p>
                <p><strong>Prénom:</strong> <?php echo htmlspecialchars($client['prenom']); ?></p>
                <p><strong>Date de Naissance:</strong> <?php echo htmlspecialchars($client['DateNaissance']); ?></p>
                <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($client['telephone']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><strong>CIN:</strong> <?php echo htmlspecialchars($client['cin']); ?></p>
                <p><strong>Lieu de Naissance:</strong> <?php echo htmlspecialchars($client['LieuNaissance']); ?></p>
                <p><strong>Téléphone Père:</strong> <?php echo htmlspecialchars($client['TelephonePere']); ?></p>
                <p><strong>Téléphone Mère:</strong> <?php echo htmlspecialchars($client['TelephoneMere']); ?></p>
                <p><strong>Adresse:</strong> <?php echo htmlspecialchars($client['Adresse']); ?></p>
            <?php else: ?>
                <p>Client not found.</p>
            <?php endif; ?>
        </div>
    </div>
</div> 
</body>
</html>
