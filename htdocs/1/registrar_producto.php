<?php

include 'modelo/conexion.php'; 

header('Content-Type: text/plain'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $concentracion = $conn->real_escape_string($_POST['concentracion']); 
    $adicional = $conn->real_escape_string($_POST['adicional']); 
    $precio = (float)$_POST['precio'];
    $prod_lab = (int)$_POST['prod_lab'];
    $prod_tip = (int)$_POST['prod_tip'];
    $prod_pre = (int)$_POST['prod_pre'];


    
    $sql = "INSERT INTO producto (nombre, concentracion, adicional, precio, prod_lab, prod_tip, prod_pre)
            VALUES (
                '$nombre', 
                '$concentracion', 
                '$adicional', 
                $precio, 
                $prod_lab, 
                $prod_tip,  
                $prod_pre
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