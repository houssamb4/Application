<?php
class Facture {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addInvoice($clientId, $prix, $date, $status) {
        $sql = "INSERT INTO Recette (Client_id, Prix, Date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idss", $clientId, $prix, $date, $status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteInvoice($invoiceId) {
        $sql = "DELETE FROM Recette WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $invoiceId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function listInvoices() {
        $sql = "SELECT Recette.id, clients.nom, clients.prenom, Recette.Prix, Recette.Date, Recette.status 
                FROM Recette 
                JOIN clients ON Recette.Client_id = clients.id
                ORDER BY Recette.Date DESC";
        $result = $this->conn->query($sql);

        $invoices = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $invoices[] = $row;
            }
        }
        return $invoices;
    }
}
?>
