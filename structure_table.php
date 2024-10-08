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
SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = '$db' 
ORDER BY TABLE_NAME, ORDINAL_POSITION;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $current_table = '';
    
    while ($row = $result->fetch_assoc()) {
        if ($current_table != $row['TABLE_NAME']) {
            if ($current_table != '') {
                echo "<br>";
            }
            $current_table = $row['TABLE_NAME'];
            echo "<strong>Table: " . $current_table . "</strong><br>";
        }
        echo "- Column: " . $row['COLUMN_NAME'] . " (" . $row['DATA_TYPE'] . ")<br>";
    }
} else {
    echo "No tables found in the database.";
}

$conn->close();
?>   