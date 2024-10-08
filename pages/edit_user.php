<?php
include('../config/database.php');

// Récupérer l'id de l'utilisateur à modifier
$id = $_GET['id'];

// Récupérer les informations actuelles de l'utilisateur
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles données du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Mise à jour dans la base de données
    $update_sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', role='$role' WHERE id = $id";
    $conn->query($update_sql);

    // Rediriger vers la liste après la modification
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
    <title>Modifier un Admin</title>
</head>

<body>

    <h1>Modifier l'admin</h1>

    <form method="POST">
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <select name="role" required>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="superadmin" <?php if ($user['role'] == 'superadmin') echo 'selected'; ?>>Super Admin</option>
        </select>
        <input type="submit" value="Modifier">
    </form>

</body>

</html>
