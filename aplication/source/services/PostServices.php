<?php
/**
 * Description of PostServices
 *
 * @author Enola
 */
import_aplication_file('source/models/PostDao');
class PostServices {
    protected $dao;
    
    public function __construct() {
        $this->dao= new PostDao();
    }
    
    public function posts($filtro = array(), $limit= 0, $offset= 0){
        return $this->dao->posts($filtro, $limit, $offset);
    }
    
    public function cant_posts($filtro = array()){
        return $this->dao->cant_posts($filtro);
    }
    
    public function posts_para_relaciones($filtro = array()){
        return $this->dao->posts_para_relaciones($filtro);
    }
    
    public function posts_front($limit= 0, $offset= 0){
        return $this->dao->posts_front($limit, $offset);
    }
    
    public function search_posts($find, $limit = 0, $offset = 0){
        return $this->dao->posts_search($find, $limit, $offset);
    }
    
    public function cant_posts_front(){
        return $this->dao->cant_posts_front();
    }
    
    public function cant_posts_search($find){
        return $this->dao->cant_posts_search($find);
    }
    
    public function fecha_posts($mes, $ano){
        return $this->dao->fecha_posts($mes, $ano);
    }
    
    public function tag_posts($nombre_tag){
        return $this->dao->posts_tag($nombre_tag);
    }
    
    public function ultimos_posts(){
        return $this->dao->ultimos_posts();
    }
    
    public function mas_vistos(){
        return $this->dao->mas_vistos();
    }
    
    public function ultimos_meses(){
        return $this->dao->ultimos_meses();
    }
    
    public function posts_relacionados($post_id){
        return $this->dao->posts_relacionados($post_id);
    }
    
    public function id_relaciones($post_id){
        return $this->dao->id_relaciones($post_id);
    }
    
    public function id_relaciones_tags($post_id){
        return $this->dao->id_relaciones_tags($post_id);
    }
    
    public function post($id){
        return $this->dao->post($id);
    }
    
    public function post_titulo($titulo){
        return $this->dao->post_titulo($titulo);
    }
    
    public function agregar($post, $relaciones, $tags){
        $post->fecha_alta= date("Y-m-d");
        $post->vistas= 0;
        return $this->dao->agregar($post, $relaciones, $tags);
    }
    
    public function modificar($post, $relaciones, $tags, $usuario_id = NULL){
        if($usuario_id != NULL){
            if($usuario_id != $post->autor){
                return FALSE;
            }
        }
        unset($post->fecha_alta);
        unset($post->vistas);
        return $this->dao->modificar($post, $relaciones, $tags);
    }
    
    public function agregar_vista($id){
        $post= $this->post($id);
        $post->vistas++;
        return $this->dao->modificar_vars($post);
    }
    
    public function eliminar($id, $usuario_id = NULL){
        $post= $this->post($id);
        if($usuario_id != NULL){
            if($post->autor != $usuario_id){
                return FALSE;
            }
        }
        if($post->fecha_baja == NULL){
            $post->fecha_baja= date("Y-m-d");
        }
        return $this->dao->modificar_vars($post);
    }
    
    public function existe_post($titulo, $excepto_id = NULL){
        if($excepto_id == NULL){
            $excepto_id= 0;
        }
        if($this->dao->cant_posts_titulo($titulo, $excepto_id) == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
}
?>
