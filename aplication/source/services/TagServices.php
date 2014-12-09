<?php
/**
 * Description of TagServices
 *
 * @author Enola
 */
import_aplication_file('source/models/TagDao');
class TagServices {
    public $dao;
    public function __construct() {
        $this->dao= new TagDao();
    }
    
    public function tags(){
        return $this->dao->tags();
    }
    
    public function tags_post($post_id){
        return $this->dao->tags_post($post_id);
    }
    
    public function tag($id){
        return $this->dao->tag($id);
    }
    
    public function agregar($tag){
        return $this->dao->agregar($tag);
    }
    
    public function modificar($tag){
        return $this->dao->modificar($tag);
    }
    
    public function eliminar($id){
        return $this->dao->eliminar($id);
    }
    
    public function existe_tag($nombre, $ex_id = NULL){
        if($ex_id == NULL){
            $ex_id= 0;
        }
        if($this->dao->cant_tags($nombre, $ex_id) == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    public function tiene_post($tag_id){
        if($this->dao->cant_posts($tag_id) == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
}

?>
