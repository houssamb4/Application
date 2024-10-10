<?php
class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getClientById($id) {
        if (!$this->conn) {
            echo "Database connection is not established.";
            return false;
        }

        $query = "SELECT * FROM Client WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            echo "Error preparing statement.";
            return false;
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            echo "Error executing statement: " . implode(":", $stmt->errorInfo());
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createClient($nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $photoPath, $telephonePere = null, $telephoneMere = null) {
        $query = "INSERT INTO Client (nom, prenom, DateNaissance, telephone, LieuNaissance, email, cin, Adresse, photo, TelephonePere, TelephoneMere) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Error preparing the SQL statement: " . implode(":", $this->conn->errorInfo()));
        }

        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $prenom);
        $stmt->bindParam(3, $dateNaissance);
        $stmt->bindParam(4, $telephone);
        $stmt->bindParam(5, $lieuNaissance);
        $stmt->bindParam(6, $email);
        $stmt->bindParam(7, $cin);
        $stmt->bindParam(8, $Adresse);
        $stmt->bindParam(9, $photoPath);
        $stmt->bindParam(10, $telephonePere);
        $stmt->bindParam(11, $telephoneMere);
        
        $result = $stmt->execute();
        
        return $result;
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
        $query = "DELETE FROM Client WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $client_id, PDO::PARAM_INT); 
        return $stmt->execute();
    }
}



