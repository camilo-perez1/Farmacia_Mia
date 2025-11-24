<?php

include 'modelo/conexion.php'; 

header('Content-Type: text/plain'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $telefono = (int)$_POST['telefono'];
    $correo = $conn->real_escape_string($_POST['correo']); 
    $direccion = $conn->real_escape_string($_POST['direccion']); 
    
    $sql = "INSERT INTO proveedor (nombre, telefono
    , correo, direccion)
            VALUES (
                '$nombre', 
                $telefono, 
                '$correo', 
                '$direccion'
            )"; 

    if ($conn->query($sql) === TRUE) {
        // Respuesta de Éxito
        echo "SUCCESS: proveedor '" . $nombre . "' registrado correctamente en la BD.";
    } else {
        // Muestra la consulta completa si falla, para depurar
        echo "ERROR: Falló la inserción en la BD. Consulta SQL: " . $sql . ". Mensaje: " . $conn->error;
    }

} else {
    echo "ERROR: Este endpoint solo acepta peticiones POST.";
}

$conn->close();
?>