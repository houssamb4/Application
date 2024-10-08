<?php
include('../config/database.php');

// Récupérer l'id de l'utilisateur à supprimer
$id = $_GET['id'];

// Suppression de l'utilisateur dans la base de données
$delete_sql = "DELETE FROM users WHERE id = $id";
$conn->query($delete_sql);

// Rediriger vers la liste après la suppression
header('Location: admin_list.php');
exit();

$conn->close();
?>
