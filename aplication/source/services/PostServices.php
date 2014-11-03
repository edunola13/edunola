<?php
/**
 * Description of PostServices
 *
 * @author Enola
 */
class PostServices {
    
    private function armar_filtro_back($filtro){
        $where= array('fecha_baja IS NULL');
        if(isset($filtro['id_usuario'])){
            $where[0] = $where[0] . ' and autor = ?';
            $where[]= $filtro['id_usuario'];
        }
        if(isset($filtro['find'])){
            $where[0] = $where[0] . " and (titulo LIKE '%" . $filtro['find'] . "%' or descripcion LIKE '%" . $filtro['find'] . "%')";
        }
        if(isset($filtro['excepto_id'])){
            $where[0] = $where[0] . ' and id != ?';
            $where[]= $filtro['excepto_id'];
        }
        if(isset($filtro['habilitado'])){
            $where[0] = $where[0] . ' and habilitado = ?';
            $where[]= $filtro['habilitado'];
        }
        return $where;
    }

    public function posts($filtro = array(), $limit= 0, $offset= 0){
        $where= $this->armar_filtro_back($filtro);
        $cond= array('conditions' => $where, 'limit' => $limit, 'offset' => $offset, 'order' => 'id desc');
        return Post::all($cond);
    }
    
    public function posts_front($limit= 0, $offset= 0){
        $cond= array('conditions' => array('habilitado = ? and fecha_baja IS NULL', TRUE), 'limit' => $limit, 'offset' => $offset, 'order' => 'id desc');        
        return Post::all($cond);
    }
    
    public function search_posts($find, $limit = 0, $offset = 0){
        $cond= array('conditions' => array("(titulo LIKE '%" . $find . "%' or descripcion LIKE '%" . $find . "%') and habilitado = ? and fecha_baja IS NULL", TRUE), 'limit' => $limit, 'offset' => $offset, 'order' => 'vistas desc');
        return Post::all($cond);
    }
    
    public function fecha_posts($mes, $ano){
        $cond= array('conditions' => array("Month(fecha_alta) = ? and  Year(fecha_alta) = ? and habilitado = ? and fecha_baja IS NULL", $mes, $ano, TRUE), 'order' => 'vistas desc');
        return Post::all($cond);
    }
    
    public function ultimos_posts(){
        $cond= array('conditions' => array('habilitado = ? and fecha_baja IS NULL', TRUE), 'limit' => 10, 'order' => 'id desc');
        return Post::all($cond);
    }
    
    public function mas_vistos(){
        $cond= array('conditions' => array('habilitado = ? and fecha_baja IS NULL', TRUE), 'limit' => 10, 'order' => 'vistas desc');
        return Post::all($cond);
    }
    
    public function ultimos_meses(){
        $cond= array('select' => 'Month(fecha_alta) as mes, Year(fecha_alta) as ano, COUNT(*) as cant', 'conditions' => array('habilitado = ? and fecha_baja IS NULL', TRUE), 'group' => 'Month(fecha_alta), Year(fecha_alta)', 'limit' => 10, 'order' => 'Year(fecha_alta) desc, Month(fecha_alta) desc');
        $posts= Post::all($cond);
        return $posts;
    }
    
    public function cant_posts($filtro = array()){
        $where= $this->armar_filtro_back($filtro);
        $cantidad= Post::find(array('select' => 'count(*) as cant', 'conditions' => $where));
        return $cantidad->cant;
    }
    
    public function cant_posts_front(){
        $cond= array('select' => 'count(*) as cant', 'conditions' => array('habilitado = ? and fecha_baja IS NULL', TRUE));
        $cantidad= Post::find($cond);
        return $cantidad->cant;
    }
    
    public function cant_posts_search($find){
        $cond= array('select' => 'count(*) as cant', 'conditions' => array("(titulo LIKE '%" . $find . "%' or descripcion LIKE '%" . $find . "%') and habilitado = ? and fecha_baja IS NULL", TRUE));
        $cantidad= Post::find($cond);
        return $cantidad->cant;
    }
    
    public function posts_relacionados($post_id){
        $options= array('conditions' => array('post_id = ?', $post_id));
        $relaciones= PostRelacion::all($options);
        $relaciones_hab= array();
        foreach ($relaciones as $relacion) {
            if($relacion->post_relacionado->habilitado != FALSE){
                $relaciones_hab[]= $relacion;
            }
        }
        return $relaciones_hab;
    }
    
    public function id_relaciones($post_id){
        $options= array('select' => 'post_relacion_id', 'conditions' => array('post_id = ?', $post_id));
        $relaciones= PostRelacion::all($options);
        $ids= array();
        foreach ($relaciones as $relacion) {
            $ids[]= $relacion->post_relacion_id;
        }
        return $ids;
    }
    
    public function post($id){
        return Post::find($id);
    }
    
    public function post_titulo($titulo){
        $options= array('conditions' => array('titulo = ?', $titulo));
        $posts= Post::all($options);
        if(isset($posts[0])){
            return $posts[0];
        }
        else{
            return NULL;
        }
    }
    
    public function agregar($post, $relaciones){
        $post->fecha_alta= date("Y-m-d");
        $post->vistas= 0;        
        if($post->save()){
            $this->agregar_relaciones($post->id, $relaciones);
        }
        return $post;
    }
    
    public function modificar($post, $relaciones = FALSE, $usuario_id = NULL){
        if($usuario_id != NULL){
            if($usuario_id != $post->autor){
                return FALSE;
            }
        }
        if($post->save() && $relaciones){
            $this->eliminar_relaciones($post->id);            
            $this->agregar_relaciones($post->id, $relaciones);
        }
        return $post;
    }
    
    protected function agregar_relaciones($post_id, $relaciones){
        if($relaciones != NULL){
            foreach ($relaciones as $id) {                
                $relacion= new PostRelacion();
                $relacion->post_id= $post_id;
                $relacion->post_relacion_id= $id;
                $relacion->save();
            }
        }
    }
    
    public function eliminar($id, $usuario_id = NULL){
        $post= Post::find($id);
        if($usuario_id != NULL){
            if($post->autor != $usuario_id){
                return FALSE;
            }
        }
        if($post->fecha_baja == NULL){
            $post->fecha_baja= date("Y-m-d");
            $this->eliminar_relacionados($post->id);
        }
        $post->save();
        return $post;
    }
    
    public function eliminar_posts($id_usuario){
        $cond= array('conditions' => array('autor = ?', $id_usuario));
        $posts= Post::all($cond); 
        foreach ($posts as $post) {
            if($post->fecha_baja == NULL){
                $post->fecha_baja= date("Y-m-d");
            }
            $post->save();
        }
    }
    
    protected function eliminar_relaciones($post_id){
        PostRelacion::table()->delete(array('post_id' => array($post_id)));
    }
    
    protected function eliminar_relacionados($post_relacion_id){
        PostRelacion::table()->delete(array('post_relacion_id' => array($post_relacion_id)));
    }
    
    public function existe_post($titulo, $excepto_id = NULL){
        $options= array();
        if($excepto_id != NULL){
            $options= array('conditions' => array('titulo = ? and id != ?', $titulo, $excepto_id));
        }
        else{
            $options= array('conditions' => array('titulo = ?', $titulo));
        }
        $posts= Post::all($options);
        if(count($posts) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}
?>
