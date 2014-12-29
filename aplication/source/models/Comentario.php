<?php
/**
 * Description of Comentario
 *
 * @author Enola
 */
class Comentario {
    public $id;
    public $nombre;
    public $comentario;
    public $habilitado= TRUE;
    public $fecha;
    public $post_id;
    public $usuario_id;
    
    private $usuario;
    
    public function __construct() {
    }
    
    public function getUsuario(){
        return $this->usuario;
    }    
    public function setUsuario($usuario){
        $this->usuario= $usuario;
    }
    public function nombreUsuario(){
        if($this->usuario == NULL){
            return 'Anonimo';
        }
        else{
            return $this->usuario->usuario;
        }
    }
}

?>