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
echo "Connected successfully";
?>