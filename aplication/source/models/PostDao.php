<?php
/**
 * Description of PostDao
 *
 * @author Enola
 */
import_aplication_file('source/models/Post');
import_aplication_file('source/models/UsuarioDao');
class PostDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function posts($filtros, $limit= 0, $offset= 0){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and (0=:id_usuario or autor=:id_usuario) limit ' . $limit . ' offset ' . $offset);
        $consulta->execute($filtros);
        return $this->results_in_objects($consulta, 'Post');
    }
    
    public function cant_posts($filtros){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM post WHERE fecha_baja IS NULL and (0=:id_usuario or autor=:id_usuario)');
        $consulta->execute($filtros);
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function posts_para_relaciones($filtros){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado=TRUE and autor=:id_usuario and id!=:id_excepto');
        $consulta->execute($filtros);
        return $this->results_in_objects($consulta, 'Post');
    }
    
    public function posts_front($limit= 0, $offset= 0){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado = TRUE limit ' . $limit . ' offset ' . $offset);
        $consulta->execute();
        $posts= $this->results_in_objects($consulta, 'Post');
        $userDao= new UsuarioDao();            
        foreach ($posts as $post) {
            $post->usuario= $userDao->usuario($post->autor);
        }
        return $posts;
    }
    
    public function cant_posts_front(){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM post WHERE fecha_baja IS NULL and habilitado = TRUE');
        $consulta->execute();
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function posts_search($find, $limit= 0, $offset= 0){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado = TRUE and 
            (titulo LIKE :find or descripcion LIKE :find) limit ' . $limit . ' offset ' . $offset);
        $consulta->execute(array(':find' => '%'.$find.'%'));
        $posts= $this->results_in_objects($consulta, 'Post');
        $userDao= new UsuarioDao();            
        foreach ($posts as $post) {
            $post->usuario= $userDao->usuario($post->autor);
        }
        return $posts;
    }
    
    public function cant_posts_search($find){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM post WHERE fecha_baja IS NULL and habilitado = TRUE and
            (titulo LIKE :find or descripcion LIKE :find)');
        $consulta->execute(array(':find' => '%'.$find.'%'));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function fecha_posts($mes, $ano){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado = TRUE and 
            Month(fecha_alta) = :mes and  Year(fecha_alta) = :ano');
        $consulta->execute(array('mes' => $mes, 'ano' => $ano));
        $posts= $this->results_in_objects($consulta, 'Post');
        $userDao= new UsuarioDao();            
        foreach ($posts as $post) {
            $post->usuario= $userDao->usuario($post->autor);
        }
        return $posts;
    }
    
    public function posts_tag($nombre_tag){
        $consulta= $this->conexion->prepare('SELECT p.id, p.titulo, p.descripcion, p.fecha_alta, p.autor FROM post as p INNER JOIN post_tag as pt ON p.id=pt.post_id INNER JOIN tag as t ON t.id=pt.tag_id
            WHERE fecha_baja IS NULL and habilitado = TRUE and t.nombre=:nombre');
        $consulta->execute(array('nombre' => $nombre_tag));
        $posts= $this->results_in_objects($consulta, 'Post');
        $userDao= new UsuarioDao();            
        foreach ($posts as $post) {
            $post->usuario= $userDao->usuario($post->autor);
        }
        return $posts;
    }
    
    public function ultimos_posts(){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado = TRUE order by id desc limit 10');
        $consulta->execute();
        return $this->results_in_objects($consulta, 'Post');
    }
    
    public function mas_vistos(){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE fecha_baja IS NULL and habilitado = TRUE order by vistas desc limit 10');
        $consulta->execute();
        return $this->results_in_objects($consulta, 'Post');
    }
    
    public function ultimos_meses(){
        $consulta= $this->conexion->prepare('SELECT Month(fecha_alta) as mes, Year(fecha_alta) as ano, COUNT(*) as cant FROM post 
            WHERE fecha_baja IS NULL and habilitado = TRUE 
            GROUP BY Month(fecha_alta), Year(fecha_alta)
            order by vistas limit 10');
        $consulta->execute();
        $arreglo= array();
        while($object= $consulta->fetchObject()){
            $arreglo[]= $object;
        }
        return $arreglo;
    }
    
    public function posts_relacionados($post_id){
        $consulta= $this->conexion->prepare('SELECT p.id, titulo, descripcion FROM post as p INNER JOIN post_relacion as pr ON p.id=pr.post_relacion_id WHERE fecha_baja IS NULL and habilitado = TRUE 
            and pr.post_id=:post_id');
        $consulta->execute(array(':post_id' => $post_id));
        return $this->results_in_objects($consulta, 'Post');
    }
    
    public function id_relaciones($post_id){
        $consulta= $this->conexion->prepare('SELECT post_relacion_id FROM post_relacion 
            WHERE post_id=:post_id');
        $consulta->execute(array(':post_id' => $post_id));
        $ids= array();
        while($object= $consulta->fetchObject()){
            $ids[]= $object->post_relacion_id;
        }
        return $ids;
    }
    
    public function id_relaciones_tags($post_id){
        $consulta= $this->conexion->prepare('SELECT tag_id FROM post_tag 
            WHERE post_id=:post_id');
        $consulta->execute(array(':post_id' => $post_id));
        $ids= array();
        while($object= $consulta->fetchObject()){
            $ids[]= $object->tag_id;
        }
        return $ids;
    }
    
    public function post($id){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE id=:id');
        $consulta->execute(array(':id' => $id));
        return $this->first_result_in_object($consulta, 'Post');
    }
    
    public function post_titulo($titulo){
        $consulta= $this->conexion->prepare('SELECT * FROM post WHERE titulo=:titulo');
        $consulta->execute(array(':titulo' => $titulo));
        $post= $this->first_result_in_object($consulta, 'Post');
        if($post != NULL){
            $userDao= new UsuarioDao();
            $post->usuario= $userDao->usuario($post->autor);
        }
        return $post;
    }
    
    public function cant_posts_titulo($titulo, $ex_id){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM post WHERE titulo = :titulo and id != :id');
        $consulta->execute(array('titulo' => $titulo, 'id' => $ex_id));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function agregar($post, $relaciones = FALSE, $tags = FALSE){
        $this->conexion->beginTransaction();
        try{
            $this->add_object('post', $post);
            $post= $this->post_titulo($post->titulo);
            if($relaciones){
                foreach ($relaciones as $relacion) {
                    $consulta= $this->conexion->prepare('INSERT INTO post_relacion(post_id, post_relacion_id) values(:post_id, :post_relacion_id)');
                    $consulta->execute(array(':post_id' => $post->id, ':post_relacion_id' => $relacion));
                }
            }
            if($tags){
                foreach ($tags as $tag) {
                    $consulta= $this->conexion->prepare('INSERT INTO post_tag(post_id, tag_id) values(:post_id, :tag_id)');
                    $consulta->execute(array(':post_id' => $post->id, ':tag_id' => $tag));
                }
            }
            $this->conexion->commit();
            return TRUE;
        } catch (PDOException $e){
            $this->conexion->rollBack();
            return FALSE;
        }
    }
    
    public function modificar($post, $relaciones = FALSE, $tags = FALSE){
        $this->conexion->beginTransaction();
        try{
            $this->update_object('post', $post, 'id=:id');
            $eliminar= $this->conexion->prepare('DELETE FROM post_relacion WHERE post_id = :post_id');
            $eliminar->execute(array(':post_id' => $post->id));
            if($relaciones){                
                foreach ($relaciones as $relacion) {
                    $consulta= $this->conexion->prepare('INSERT INTO post_relacion(post_id, post_relacion_id) values(:post_id, :post_relacion_id)');
                    $consulta->execute(array(':post_id' => $post->id, ':post_relacion_id' => $relacion));
                }
            }
            $eliminar_tag= $this->conexion->prepare('DELETE FROM post_tag WHERE post_id = :post_id');
            $eliminar_tag->execute(array(':post_id' => $post->id));
            if($tags){                
                foreach ($tags as $tag) {
                    $consulta= $this->conexion->prepare('INSERT INTO post_tag(post_id, tag_id) values(:post_id, :tag_id)');
                    $consulta->execute(array(':post_id' => $post->id, ':tag_id' => $tag));
                }
            }
            $this->conexion->commit();
            return TRUE;
        } catch (PDOException $e){
            echo $e;
            $this->conexion->rollBack();
            return FALSE;
        }
    }
    
    public function modificar_vars($post){
        $this->conexion->beginTransaction();
        try{
            $this->update_object('post', $post, 'id=:id');
            $this->conexion->commit();
            return TRUE;
        } catch (PDOException $e){
            echo $e;
            $this->conexion->rollBack();
            return FALSE;
        }
    }
}

?>
