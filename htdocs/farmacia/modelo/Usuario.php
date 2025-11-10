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
        $sql = "SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where dni_us=:dni and contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni' => $dni, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function obtener_datos($id)
    {
        $sql = "SELECT * FROM usuario join us_tipo on us_tipo=id_tipo_us and id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    // ########## CÓDIGO FALTANTE AÑADIDO (INICIO) ##########
    
    function editar($id, $telefono, $residencia, $correo, $sexo, $adicional)
    {
        $sql = "UPDATE usuario SET
            telefono_us = :telefono,
            residencia_us = :residencia,
            correo_us = :correo,
            sexo_us = :sexo,
            adicional_us = :adicional
        WHERE id_usuario = :id";

        $query = $this->acceso->prepare($sql);
        $variables = array(
            ':id' => $id,
            ':telefono' => $telefono,
            ':residencia' => $residencia,
            ':correo' => $correo,
            ':sexo' => $sexo,
            ':adicional' => $adicional
        );

        if ($query->execute($variables)) {
            return 'editado'; // Devuelve 'editado' si la consulta tuvo éxito
        } else {
            // Opcional: puedes devolver el error para depurar
            // return $query->errorInfo();
            return 'no_editado';
        }
    }

    // ########## CÓDIGO FALTANTE AÑADIDO (FIN) ##########
}
?>