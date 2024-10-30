<?php
class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getClientById($id) {
        $sql = "SELECT * FROM Client WHERE id = ?"; // Corrected here
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            } else {
                echo "Error executing query: " . $stmt->error; // for debugging
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->conn->error; // for debugging
        }
        return null;
    }
    

    public function createClient($nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $photoPath, $telephonePere = null, $telephoneMere = null) {
        $query = "INSERT INTO Client (nom, prenom, DateNaissance, telephone, LieuNaissance, email, cin, Adresse, photo, TelephonePere, TelephoneMere) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Error preparing the SQL statement: " . $this->conn->error);
        }
    
        $stmt->bind_param("sssssssssss", $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $Adresse, $photoPath, $telephonePere, $telephoneMere);
        
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

    public function countClients() {
        $query = "SELECT COUNT(*) as total FROM Client";
        $result = $this->conn->query($query);
    
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
    
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function countutilisateur() {
        $query = "SELECT COUNT(*) as total FROM users";
        $result = $this->conn->query($query);
    
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
    
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function updateClient($id, $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $adresse, $photo, $telephonePere = null, $telephoneMere = null) {
        $sql = "UPDATE client SET nom=?, prenom=?, DateNaissance=?, telephone=?, LieuNaissance=?, email=?, cin=?, Adresse=?, photo=?, TelephonePere=?, TelephoneMere=? WHERE id=?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sssssssssssi", $nom, $prenom, $dateNaissance, $telephone, $lieuNaissance, $email, $cin, $adresse, $photo, $telephonePere, $telephoneMere, $id);
            
            if ($stmt->execute()) {
                $stmt->close();
                return true; // Return true if update is successful
            } else {
                echo "Error updating record: " . $stmt->error; // Debugging output
            }
        } else {
            echo "Error preparing statement: " . $this->conn->error; // Debugging output
        }
        
        return false; // Return false if update fails
    }

}



