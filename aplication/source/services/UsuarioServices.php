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
    protected $dao;
    public function __construct() {
        $this->dao= new UsuarioDao();
    }
    
    public function iniciarSesion($usuario, $clave){
        $clave= encode_md5_y_sha_1($clave);        
        return $this->dao->usuario_activo($usuario, $clave);
    }
    
    public function usuarios($id){
        return $this->dao->usuarios($id);
    }
    
    public function usuario($id){
        return $this->dao->usuario($id);
    }
    
    public function agregar($usuario){
        $usuario->fecha_alta= date("Y-m-d");
        $usuario->clave= encode_md5_y_sha_1($usuario->clave);
        $this->dao->agregar($usuario);
        return $usuario;
    }
    
    public function modificar($usuario, $modClave = FALSE){
        unset($usuario->fecha_alta);
        unset($usuario->fecha_baja);
        if($modClave){
            $usuario->clave= encode_md5_y_sha_1($usuario->clave);
        }
        else{
            unset($usuario->clave);
        }
        $this->dao->modificar($usuario);
        return $usuario;
    }

    public function eliminar($id){
        $usuario= $this->usuario($id);
        if($usuario->usuario == 'eduardo_n'){
            return FALSE;
        }
        if($usuario->fecha_baja == NULL){
            $usuario->fecha_baja= date("Y-m-d");
        }
        $this->dao->eliminar($usuario);
        return $usuario;
    }

    public function existe_usuario($usuario, $ex_id = NULL){
        if($ex_id == NULL){
            $ex_id= 0;
        }
        if($this->dao->cant_usuarios($usuario, $ex_id) == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
}

?>
