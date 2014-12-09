<?php
/**
 * Description of TagDao
 *
 * @author Enola
 */
import_aplication_file('source/models/Tag');
class TagDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function tags(){
        $consulta= $this->conexion->prepare('SELECT * FROM tag');
        $consulta->execute();
        return $this->results_in_objects($consulta, 'Tag');
    }
    
    public function tags_post($post_id){
        $consulta= $this->conexion->prepare('SELECT t.id, t.nombre FROM tag as t INNER JOIN post_tag as pt ON t.id=pt.tag_id 
            WHERE pt.post_id=:post_id');
        $consulta->execute(array('post_id' => $post_id));
        return $this->results_in_objects($consulta, 'Tag');
    }
    
    public function tag($id){
        $consulta= $this->conexion->prepare('SELECT * FROM tag WHERE id=:id');
        $consulta->execute(array('id' => $id));
        return $this->first_result_in_object($consulta, 'Tag');
    }
    
    public function cant_tags($nombre, $ex_id){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM tag WHERE nombre = :nombre and id != :id');
        $consulta->execute(array('nombre' => $nombre, 'id' => $ex_id));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function agregar($tag){
        return $this->add_object('tag', $tag);
    }
    
    public function modificar($tag){
        return $this->update_object('tag', $tag, 'id=:id_tag', array('id_tag' => $tag->id));
    }
    
    public function eliminar($id){
        $consulta= $this->conexion->prepare('DELETE FROM tag WHERE id = :id');
        $consulta->execute(array('id' => $id));
        $error= $consulta->errorInfo();
        if($error[0] != 00000){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    public function cant_posts($tag_id){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM tag as t INNER JOIN post_tag as pt ON t.id=pt.tag_id 
            WHERE t.id = :id');
        $consulta->execute(array('id' => $tag_id));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
}

?>
