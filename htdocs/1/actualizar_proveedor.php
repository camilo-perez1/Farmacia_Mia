<?php

// Asegúrate de incluir la conexión
include 'modelo/conexion.php'; 

// Indicamos que la respuesta será JSON (es mejor para APIs)
header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    
    // 1. LEER LOS DATOS DE LA PETICIÓN PUT (SOLUCIÓN AL ERROR)
    // PHP no llena $_PUT, leemos la entrada cruda y la parseamos.
    parse_str(file_get_contents('php://input'), $_PUT); 

    // 2. OBTENER DATOS (Necesitas el ID del proveedor a actualizar)
    // Asegúrate de enviar 'id_proveedor' en el Body de Postman
    $id_proveedor = (int)$_PUT['id_proveedor']; // Clave para saber qué fila actualizar
    
    $nombre = $conn->real_escape_string($_PUT['nombre']);
    $telefono = $conn->real_escape_string($_PUT['telefono']); // CRUCIAL: Mantener como string si puede tener guiones o formatos
    $correo = $conn->real_escape_string($_PUT['correo']); 
    $direccion = $conn->real_escape_string($_PUT['direccion']); 
    
    // 3. SENTENCIA SQL: USAR UPDATE EN LUGAR DE INSERT (CORRECCIÓN LÓGICA)
    $sql = "UPDATE proveedor SET 
                nombre = '$nombre', 
                telefono = '$telefono', 
                correo = '$correo', 
                direccion = '$direccion'
            WHERE id_proveedor = $id_proveedor"; // ¡CRÍTICO! Actualizar solo al proveedor específico

    if ($conn->query($sql) === TRUE) {
        // Respuesta de Éxito
        if ($conn->affected_rows > 0) {
             echo json_encode(["SUCCESS" => "Proveedor actualizado: " . $nombre]);
        } else {
             echo json_encode(["SUCCESS" => "No se realizó ningún cambio (ID existente, pero datos iguales)."]);
        }
    } else {
        // Respuesta de Error
        echo json_encode(["ERROR" => "Fallo al actualizar. Mensaje: " . $conn->error, "SQL" => $sql]);
    }

} else {
    // Si la petición no es PUT, la rechaza.
    echo json_encode(["ERROR" => "Este endpoint solo acepta peticiones PUT."]);
}

$conn->close();
?>