<?php
include('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe

    // Insertion dans la base de données
    $insert_sql = "INSERT INTO users (first_name, last_name, email, role, password, created_at) 
                   VALUES ('$first_name', '$last_name', '$email', '$role', '$password', NOW())";
    $conn->query($insert_sql);

    // Rediriger vers la liste après l'ajout
    header('Location: admin_list.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Admin</title>
</head>

<body>

    <h1>Ajouter un nouvel admin</h1>

    <form method="POST">
        <input type="text" name="first_name" placeholder="Prénom" required>
        <input type="text" name="last_name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>
        <input type="submit" value="Ajouter">
    </form>

</body>

</html>
