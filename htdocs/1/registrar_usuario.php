<?php
include 'modelo/conexion.php'; 

header('Content-Type: text/plain'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre_us = $conn->real_escape_string($_POST['nombre_us']);
    $apellidos_us = $conn->real_escape_string($_POST['apellidos_us']);
    $edad = (int)$_POST['edad']; 
    $dni_us = $conn->real_escape_string($_POST['dni_us']); 
    $contrasena_us = $conn->real_escape_string($_POST['contrasena_us']); 
    $us_tipo = (int)$_POST['us_tipo'];

    $sql = "INSERT INTO usuario (nombre_us, apellidos_us, edad, dni_us, contrasena_us, us_tipo)
            VALUES (
                '$nombre_us', 
                '$apellidos_us', 
                $edad, 
                '$dni_us', 
                '$contrasena_us', 
                $us_tipo
            )"; 

    if ($conn->query($sql) === TRUE) {
        // Respuesta de Éxito
        echo "SUCCESS: usuario '" . $nombre_us . "' registrado correctamente en la BD.";
    } else {
        // Muestra la consulta completa si falla, para depurar
        echo "ERROR: Falló la inserción en la BD. Consulta SQL: " . $sql . ". Mensaje: " . $conn->error;
    }

} else {
    echo "ERROR: Este endpoint solo acepta peticiones POST.";
}

$conn->close();
?>