<?php
session_start(); 

class Login {
    
    private $conn;
    
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function authenticateUser($email, $password) {
        $sql = "SELECT id, first_name, last_name, password FROM users WHERE email = ?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $first_name, $last_name, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;

                    return true; 
                } else {
                    return "Incorrect password.";
                }
            } else {
                return "No account found with this email.";
            }

            $stmt->close();
        } else {
            return "Error preparing statement: " . $this->conn->error;
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_unset();  
        session_destroy(); 
    }
}
?>
