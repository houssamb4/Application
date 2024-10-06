<?php
$host = '6sq.h.filess.io';
$db = 'SportAcademie_forwardhim';
$user = 'SportAcademie_forwardhim';
$pass = '976d732b5c56ce607c53a3e9d47877a184c1dbf3';
$port = '3307';

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
CREATE TABLE Groupe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Categorie_id INT NOT NULL,
    Horaire_id INT NOT NULL,
    NumeroGroupe VARCHAR(50) NOT NULL,
    FOREIGN KEY (Categorie_id) REFERENCES Categorie(id),
    FOREIGN KEY (Horaire_id) REFERENCES Horaire(id) -- Assurez-vous que la table Horaire existe
);

";

if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>
