<?php
/**
 * Description of ComentarioDao
 *
 * @author Enola
 */
import_aplication_file('source/models/Comentario');
import_aplication_file('source/models/UsuarioDao');
class ComentarioDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function comentarios($post_id){
        $consulta= $this->conexion->prepare('SELECT * FROM comentario WHERE post_id=:id and habilitado=TRUE order by fecha asc');
        $consulta->execute(array('id' => $post_id));
        $comentarios= $this->results_in_objects($consulta, 'Comentario');
        $daoUser= new UsuarioDao();
        foreach ($comentarios as $comentario) {
            $comentario->setUsuario($daoUser->usuario($comentario->usuario_id));
        }
        return $comentarios;
    }
    
    public function comentario($id){
        $consulta= $this->conexion->prepare('SELECT * FROM comentario WHERE id=:id');
        $consulta->execute(array(':id' => $id));
        return $this->first_result_in_object($consulta, 'Comentario');
    }
    
    public function add_comentario($comentario){
        return $this->add_object('comentario', $comentario);
    }
    
    public function update_comentario($comentario){
        return $this->update_object('comentario', $comentario, 'id=:id');
    }
}

?>