<?php
ob_clean(); // limpia cualquier salida previa
header('Content-Type: application/json; charset=utf-8');
error_reporting(0); // Incluir el modelo de Usuario
include_once  '../modelo/Usuario.php';
$usuario = new Usuario();

if ($_POST['funcion'] == 'buscar_usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
            'edad' =>$edad_years,
            'dni' => $objeto->dni_us,
            'tipo' => $objeto->us_tipo,
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us // Agregado para consistencia
        );
    }  
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
  
}

if ($_POST['funcion'] == 'capturar_datos') {
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us // Agregado para consistencia
        );
    }  
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
  
}


if ($_POST['funcion'] == 'editar_usuario') {
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $resultado = $usuario->editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional);
    
    
    if ($resultado === true) { 
        echo json_encode(['status' => 'success']); // Esto SÍ es JSON
    } else {
        echo json_encode(['status' => 'error']); // Esto también es JSON
    }
}

if ($_POST['funcion'] == 'cambiar_contra') {
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $resultado = $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);

    if ($resultado === true) { 
        echo json_encode(['status' => 'success']); // Esto SÍ es JSON
    }else if ($resultado === 'wrong-pass') {
        echo json_encode(['status' => 'error_pass']); // Contraseña antigua incorrecta
    } else {
        echo json_encode(['status' => 'error']); // Esto también es JSON
    }
}
?>