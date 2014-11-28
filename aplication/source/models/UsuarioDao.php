<?php

/**
 * Description of UsuarioDao
 *
 * @author Enola
 */
class UsuarioDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function usuario_activo($usuario, $clave){
        $consulta= $this->conexion->prepare('SELECT * FROM usuario WHERE usuario = :usuario and clave = :clave and habilitado = TRUE and fecha_baja IS NULL');
        $consulta->execute(array('usuario' => $usuario, 'clave' => $clave));
        $resultado= $consulta->fetchObject();
        return $resultado;
    }
}

?>
