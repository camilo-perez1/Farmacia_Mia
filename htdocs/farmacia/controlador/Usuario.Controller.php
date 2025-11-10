<?php
ob_clean(); // limpia cualquier salida previa
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);

// Incluir el modelo de Usuario
include_once __DIR__ . '/../modelo/Usuario.php';

$usuario = new Usuario();

if (isset($_POST['funcion']) && $_POST['funcion'] == 'buscar_usuario') {
    $json = array();

    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
            'edad' => $objeto->edad,
            'identificacion' => $objeto->dni_us,
            'us_tipo' => $objeto->us_tipo,
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us
        );
    }

    if (!empty($json)) {
        ob_end_clean(); // asegura salida limpia
        echo json_encode($json[0]);
    } else {
        ob_end_clean();
        echo json_encode(array());
    }
    exit; // corta ejecución, evita que se imprima HTML adicional
}
?>