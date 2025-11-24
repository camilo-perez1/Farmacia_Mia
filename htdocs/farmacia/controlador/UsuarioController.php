<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);
//xvxvxvxvxvxvxvxvxvxvxvxvxvxx
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
session_start();
$id_usuario = $_SESSION['usuario']; 

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
            'edad' => $edad_years,
            'dni' => $objeto->dni_us,
            'tipo' => $objeto->us_tipo,
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us, 
            'avatar' => '../img/'.$objeto->avatar
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
            'adicional' => $objeto->adicional_us
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
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

if ($_POST['funcion'] == 'cambiar_contra') {
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $resultado = $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);
   
    if ($resultado === true) { 
        echo json_encode(['status' => 'success']);
    } else if ($resultado === 'wrong-pass') {
        echo json_encode(['status' => 'error_pass']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

if ($_POST['funcion'] == 'cambiar_foto') {
    if (($_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/png' || $_FILES['photo']['type'] == 'image/gif')) {
        // CORREGIDO: $_FILES en lugar de $_file
        $nombre = uniqid().'-'.$_FILES['photo']['name'];
        $ruta = '../img/'.$nombre;
        
        // CORREGIDO: $_FILES en lugar de $_file
        move_uploaded_file($_FILES['photo']['tmp_name'], $ruta);
        
        // Obtener avatar actual antes de actualizar
        $usuario->cambiar_photo($id_usuario, $nombre);
        
        foreach ($usuario->objetos as $objeto) {
            // Solo eliminar si no es el avatar por defecto
            if ($objeto->avatar != 'avatar04.png' && file_exists('../img/'.$objeto->avatar)) {
                unlink('../img/'.$objeto->avatar);
            }
        }
        
        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}
?>