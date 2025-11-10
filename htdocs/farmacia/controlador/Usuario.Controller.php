<?php
ob_clean(); // limpia cualquier salida previa
header('Content-Type: application/json; charset=utf-8');
error_reporting(0); // Incluir el modelo de Usuario
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
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us // Agregado para consistencia
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

// ########## CÓDIGO FALTANTE AÑADIDO (INICIO) ##########

if (isset($_POST['funcion']) && $_POST['funcion'] == 'capturar_datos') {
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);

    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us
        );
    }

    if (!empty($json)) {
        ob_end_clean();
        // Devuelve el JSON como un string, ya que JS usa JSON.parse()
        echo json_encode($json[0]);
    } else {
        ob_end_clean();
        echo json_encode(array());
    }
    exit;
}

if (isset($_POST['funcion']) && $_POST['funcion'] == 'editar_usuario') {
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];

    // Llama a la función en el modelo (que también debes crear)
    $resultado = $usuario->editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional);

    if ($resultado == 'editado') {
        ob_end_clean();
        echo 'editado'; // Envía la respuesta que JS espera
    } else {
        ob_end_clean();
        echo 'no_editado'; // Opcional, para manejar errores
    }
    exit;
}

// ########## CÓDIGO FALTANTE AÑADIDO (FIN) ##########

?>