<?php

/**
 * Description of UsuarioDao
 *
 * @author Enola
 */
import_aplication_file('source/models/User');
class UsuarioDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function usuario_activo($usuario, $clave){
        $consulta= $this->conexion->prepare('SELECT * FROM usuario WHERE usuario = :usuario and clave = :clave and habilitado = TRUE and fecha_baja IS NULL');
        $consulta->execute(array('usuario' => $usuario, 'clave' => $clave));
        return $this->first_result_in_object($consulta, 'User');
    }
    
    public function usuarios($id){
        $consulta= $this->conexion->prepare('SELECT * FROM usuario WHERE usuario != :usuario and id != :id and fecha_baja IS NULL');
        $consulta->execute(array('usuario' => 'eduardo_n', 'id' => $id));
        return $this->results_in_objects($consulta, 'User');
    }
    
    public function cant_usuarios($usuario, $ex_id){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM usuario WHERE usuario = :usuario and id != :id');
        $consulta->execute(array('usuario' => $usuario, 'id' => $ex_id));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }

    public function usuario($id){
        $consulta= $this->conexion->prepare('SELECT * FROM usuario WHERE id = :id and fecha_baja IS NULL');
        $consulta->execute(array('id' => $id));
        return $this->first_result_in_object($consulta, 'User');
    }
    
    public function agregar($usuario){
        return $this->add_object('usuario', $usuario);
    }
    
    public function modificar($usuario){
        return $this->update_object('usuario', $usuario, 'id=:id_user', array('id_user' => $usuario->id));
    }
    
    public function eliminar($usuario){
        $this->conexion->beginTransaction();
        try{
            $this->update_object('usuario', $usuario, 'id=:id_user', array('id_user' => $usuario->id));

            $consulta2= $this->conexion->prepare('UPDATE post SET fecha_baja=:fecha_baja WHERE autor=:id and fecha_baja is null');
            $consulta2->execute(array('id' => $usuario->id, 'fecha_baja' => $usuario->fecha_baja));

            $this->conexion->commit();
            return TRUE;
        } catch (PDOException $e){
            $this->conexion->rollBack();
            return FALSE;
        }
    }
}

?>
