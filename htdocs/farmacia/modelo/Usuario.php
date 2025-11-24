<?php
include_once 'Conexion.php';

class Usuario
{
    var $objetos;
    private $acceso;
    
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    
    function Loguearse($dni, $pass)
    {
        $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo=id_tipo_us WHERE dni_us=:dni AND contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni' => $dni, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
    
    function obtener_datos($id)
    {
        $sql = "SELECT * FROM usuario JOIN tipo_us ON us_tipo=id_tipo_us WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
    
    function editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional)
    {
        $sql = "UPDATE usuario SET
            telefono_us = :telefono,
            residencia_us = :residencia,
            correo_us = :correo,
            sexo_us = :sexo,
            adicional_us = :adicional
        WHERE id_usuario = :id";
        $query = $this->acceso->prepare($sql);
        return $query->execute(array(
            ':id' => $id_usuario, 
            ':telefono' => $telefono, 
            ':residencia' => $residencia, 
            ':correo' => $correo, 
            ':sexo' => $sexo, 
            ':adicional' => $adicional
        ));
    }
    
    function cambiar_contra($id_usuario, $oldpass, $newpass)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario=:id AND contrasena_us=:oldpass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario, ':oldpass' => $oldpass));
        $this->objetos = $query->fetchAll();
        
        if (!empty($this->objetos)) {
            $sql = "UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $resultado = $query->execute(array(':id' => $id_usuario, ':newpass' => $newpass));
            return $resultado ? true : false; 
        } else {
            return 'wrong-pass'; 
        }
    }
    
    function cambiar_photo($id_usuario, $nombre)
    {
        $sql = "SELECT avatar FROM usuario WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario));
        $this->objetos = $query->fetchAll();
        
        $sql = "UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario, ':nombre' => $nombre));
        return $this->objetos;
    }
}
?>