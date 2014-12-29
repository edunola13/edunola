<?php
/**
 * Description of ComentarioServices
 *
 * @author Enola
 */
import_aplication_file('source/models/ComentarioDao');
class ComentarioServices {
    private $dao;
    
    public function __construct() {
        $this->dao= new ComentarioDao();
    }
    
    public function comentarios($post_id){
        return $this->dao->comentarios($post_id);
    }
    
    public function add_comentario($comentario, $usuario = NULL){
        $comentario->fecha= date('Y-m-d H:i:s');
        if($usuario != NULL){
            $comentario->usuario_id= $usuario->id;
        }
        return $this->dao->add_comentario($comentario);
    }
    
    public function comentario($id){
        return $this->dao->comentario($id);
    }
    
    public function update_comentario($id){
        $comentario= $this->comentario($id);
        $comentario->habilitado= FALSE;
        return $this->dao->update_comentario($comentario);
    }
}

?>
