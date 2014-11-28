<?php
/**
 * Description of UsuarioServices
 *
 * @author Usuario_2
 */
/*
 * Importar
 */
import_aplication_file('source/services/PostServices');
import_aplication_file('source/models/UsuarioDao');
class UsuarioServices {
    
//    public function iniciarSesion($usuario, $clave){
//        $clave= encode_md5_y_sha_1($clave);
//        $select= array('select' => 'id, usuario, nombre, email, fecha_nacimiento, habilitado, tipo_usuario');
//        $options= array('conditions' => array('usuario = ? and clave = ? and habilitado = ? and fecha_baja IS NULL', $usuario, $clave, TRUE));
//        $usuarios= Usuario::all($select, $options);
//        if(isset($usuarios[0])){
//            return $usuarios[0];
//        }
//        else{
//            return NULL;
//        }
//    }
    
    public function iniciarSesion($usuario, $clave){
        $clave= encode_md5_y_sha_1($clave);
        $dao= new UsuarioDao();
        return $dao->usuario_activo($usuario, $clave);
    }
    
    public function usuarios($id){
        $options= array('conditions' => array('usuario != ? and id != ? and fecha_baja IS NULL', 'eduardo_n', $id));
        return Usuario::all($options);
    }
    
    public function usuario($id){
        return Usuario::find($id);
    }
    
    public function agregar($usuario){
        $usuario->fecha_alta= date("Y-m-d");
        $usuario->clave= encode_md5_y_sha_1($usuario->clave);
        $usuario->save();
        return $usuario;
    }
    
    public function modificar($usuario, $modClave = FALSE){
        if($modClave){
            $usuario->clave= encode_md5_y_sha_1($usuario->clave);
        }
        $usuario->save();
        return $usuario;
    }
    
    public function eliminar($id){
        $usuario= Usuario::find($id);
        if($usuario->fecha_baja == NULL){
            $usuario->fecha_baja= date("Y-m-d");
            $servicio= new PostServices();
            $servicio->eliminar_posts($usuario->id);
        }
        $usuario->save();
        return $usuario;
    }
    
    public function existe_usuario($usuario, $excepto_id = NULL){
        $options= array();
        if($excepto_id != NULL){
            $options= array('conditions' => array('usuario = ? and id != ?', $usuario, $excepto_id));
        }
        else{
            $options= array('conditions' => array('usuario = ?', $usuario));
        }
        $usuarios= Usuario::all($options);
        if(count($usuarios) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}

?>
