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
    
    public function usuarios($id){
        $consulta= $this->conexion->prepare('SELECT * FROM usuario WHERE usuario != :usuario and id != :id and fecha_baja IS NULL');
        $consulta->execute(array('usuario' => 'eduardo_n', 'id' => $id));
        $resultado= array();
        while($file= $consulta->fetchObject()){            
            $resultado[]= $file;
        }
        return $resultado;
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
        $resultado= $consulta->fetchObject();
        return $resultado;
    }
    
    public function agregar($usuario){
        $consulta= $this->conexion->prepare('INSERT INTO usuario (usuario, clave, nombre, fecha_alta, habilitado, fecha_nacimiento, email, tipo_usuario) 
            values(:usuario, :clave, :nombre, :fecha_alta, :habilitado, :fecha_nacimiento, :email, :tipo_usuario)');
        $consulta->execute((array)$usuario);
        return $consulta;
    }
    
    public function modificar($usuario){
        $consulta= $this->conexion->prepare('UPDATE usuario SET usuario=:usuario, clave=:clave, nombre=:nombre, habilitado=:habilitado, fecha_nacimiento=:fecha_nacimiento, email=:email, tipo_usuario=:tipo_usuario 
            WHERE id=:id');
        $consulta->execute((array)$usuario);
        
        return $consulta;
    }
    
    public function eliminar($usuario){
        $this->conexion->beginTransaction();
        try{
            $consulta= $this->conexion->prepare('UPDATE usuario SET fecha_baja=:fecha_baja WHERE id=:id');
            $consulta->execute(array('id' => $usuario->id, 'fecha_baja' => $usuario->fecha_baja));

            $consulta2= $this->conexion->prepare('UPDATE post SET fecha_baja=:fecha_baja WHERE autor=:id and fecha_baja is null');
            $consulta2->execute(array('id' => $usuario->id, 'fecha_baja' => $usuario->fecha_baja));

            $this->conexion->commit();
        } catch (PDOException $e){
            $this->conexion->rollBack();
        }
        return $consulta2;
    }
}

?>
