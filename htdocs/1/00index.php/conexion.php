<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "FarmaciaMia";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
