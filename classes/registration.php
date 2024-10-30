<?php
class Registration {

    private $conn;
    
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function registerUser($first_name, $last_name, $email, $role, $password, $confirm_password) {
        if ($password !== $confirm_password) {
            return "Passwords do not match!";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($this->isEmailRegistered($email)) {
            return "Email is already registered. Please use a different email.";
        }

        $sql = "INSERT INTO users (first_name, last_name, email, role, password) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $role, $hashed_password);

            if ($stmt->execute()) {
                return true;  
            } else {
                return "Error inserting record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error preparing statement: " . $this->conn->error;
        }
    }

    private function isEmailRegistered($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                return true;  
            }

            $stmt->close();
        }
        return false;  
    }
}
?>
