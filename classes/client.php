<?php
class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createClient($nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $photoPath, $telephonePere = null, $telephoneMere = null) {
        $query = "INSERT INTO `Client` (nom, prenom, DateNaissance, telephone, LieuNaissance, email, cin, photo, TelephonePere, TelephoneMere, `Date`)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Error preparing statement: " . $this->conn->error);
        }
    
        $stmt->bind_param("ssssssssss", $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $photoPath, $telephonePere, $telephoneMere);
        return $stmt->execute();
    }
    
    

    public function listClients() {
        $query = "SELECT * FROM Client";
        $result = $this->conn->query($query);
        
        if ($result === false) {
            die("Query failed: " . $this->conn->error); 
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    public function deleteClient($client_id) {
        $query = "DELETE FROM client WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $client_id);
        return $stmt->execute();
    }
}
