<?php
<<<<<<<< HEAD:htdocs/1/controlador/UsuarioController.php
//ob_clean(); // limpia cualquier salida previa
//header('Content-Type: application/json; charset=utf-8');
//error_reporting(0); // Incluir el modelo de Usuario
========
ob_clean(); // limpia cualquier salida previa
header('Content-Type: application/json; charset=utf-8');
error_reporting(0); // Incluir el modelo de Usuario
>>>>>>>> 0bd7b34f703b5c69562c0d20a7f24b7606ede5fa:htdocs/farmacia/controlador/UsuarioController.php
include_once  '../modelo/Usuario.php';
$usuario = new Usuario();

if ($_POST['funcion'] == 'buscar_usuario') {
    $json = array();
<<<<<<<< HEAD:htdocs/1/controlador/UsuarioController.php
    //$usuario->obtener_datos($_POST['dato']);
========
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
>>>>>>>> 0bd7b34f703b5c69562c0d20a7f24b7606ede5fa:htdocs/farmacia/controlador/UsuarioController.php
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
<<<<<<<< HEAD:htdocs/1/controlador/UsuarioController.php
            'edad' => $objeto->edad,
            'Codigo' => $objeto->dni_us,
========
            'edad' =>$edad_years,
            'dni' => $objeto->dni_us,
>>>>>>>> 0bd7b34f703b5c69562c0d20a7f24b7606ede5fa:htdocs/farmacia/controlador/UsuarioController.php
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
<<<<<<<< HEAD:htdocs/1/controlador/UsuarioController.php
    /*
    if (!empty($json)) {
        ob_end_clean(); // asegura salida limpia
        echo json_encode($json[0]);
    } else {
        ob_end_clean();
        echo json_encode(array());
    }
    exit; // corta ejecución, evita que se imprima HTML adicional*/
}

// ########## CÓDIGO FALTANTE AÑADIDO (INICIO) ##########
/*
if (isset($_POST['funcion']) && $_POST['funcion'] == 'capturar_datos') {
========
  
}

if ($_POST['funcion'] == 'capturar_datos') {
>>>>>>>> 0bd7b34f703b5c69562c0d20a7f24b7606ede5fa:htdocs/farmacia/controlador/UsuarioController.php
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

<<<<<<<< HEAD:htdocs/1/controlador/UsuarioController.php
if (isset($_POST['funcion']) && $_POST['funcion'] == 'cambiar_contra') {
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);
}
// ########## CÓDIGO FALTANTE AÑADIDO (FIN) ##########
*/
========
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
>>>>>>>> 0bd7b34f703b5c69562c0d20a7f24b7606ede5fa:htdocs/farmacia/controlador/UsuarioController.php
?>