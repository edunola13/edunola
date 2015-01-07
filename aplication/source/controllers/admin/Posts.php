<?php
/**
 * Description of Posts
 *
 * @author Enola
 */
/*
 * Importar
 */
import_aplication_file("source/services/PostServices");
import_aplication_file("source/services/TagServices");
class Posts extends En_Controller{
    protected $posts;
    protected $post;
    protected $relaciones;
    protected $tags_rel;
    protected $cant_por_pagina= 10;
    
    protected $mensaje;
    protected $mensaje_error;
    
    protected $servicioPost;
    protected $servicioTag;
    
    public function __construct() {
        parent::__construct();
        $this->servicioPost= new PostServices();
        $this->servicioTag= new TagServices();
    }
    
    public function index(){
        $usuario= $this->request->session->get_unserialize('usuario_session');
        $filtro= array('id_usuario' => $usuario->id);
        
        $cantidad= $this->servicioPost->cant_posts($filtro);
        $paginador= new Paginator($this->cant_por_pagina, $cantidad, 1);
        $this->posts= $this->servicioPost->posts($filtro, $this->cant_por_pagina);
        $this->load_view('admin/posts', $paginador);
    }
    
    public function page(){
        $usuario= $this->request->session->get_unserialize('usuario_session');
        $filtro= array('id_usuario' => $usuario->id);
        
        $pagina= 1;
        if(isset($this->params[0])){
            $pagina= $this->params[0];
        }
        $cantidad= $this->servicioPost->cant_posts($filtro);
        $paginador= new Paginator($this->cant_por_pagina, $cantidad, $pagina);
        if($paginador->number_of_pages() >= $pagina && $pagina > 0){
            $this->posts= $this->servicioPost->posts($filtro, $this->cant_por_pagina, $paginador->element_start_position());
            $this->load_view("admin/posts", $paginador);
        }
        else{
            redirect('admin/blog');
        }
    }
    
    public function delete(){
        if($this->request->request_method == "POST"){
            $usuario= $this->request->session->get_unserialize('usuario_session');
            $filtro= array('id_usuario' => $usuario->id);
            
            if($this->request->param_post('id') != NULL){
                if($usuario->tipo_usuario == 'administrador'){
                    $rta= $this->servicioPost->eliminar($this->request->param_post('id'));
                }
                else{
                    $rta= $this->servicioPost->eliminar($this->request->param_post('id'), $usuario->id);
                }
                if($rta){
                    $this->mensaje= "El post fue eliminado correctamente.";
                }
                else{
                    $this->mensaje= "Hubo un error eliminando el post.";
                }
                $pagina= $this->request->param_post('page');
                $cantidad= $this->servicioPost->cant_posts($filtro);
                $paginador= new Paginator($this->cant_por_pagina, $cantidad, $pagina);
                if($paginador->number_of_pages() >= $pagina && $pagina > 0){
                    $this->posts= $this->servicioPost->posts($filtro, $this->cant_por_pagina, $paginador->element_start_position());
                    $this->load_view("admin/sections_post/tabla_posts", $paginador);
                }
                else{
                    $paginador= new Paginator($this->cant_por_pagina, $cantidad, 1);
                    $this->posts= $this->servicioPost->posts($filtro, $this->cant_por_pagina);
                    $this->load_view("admin/sections_post/tabla_posts", $paginador);
                }
            }
        }
    }
    
    public function add(){
        $usuario= $this->request->session->get_unserialize('usuario_session');
        $filtro= array('id_usuario' => $usuario->id, 'id_excepto' => 0);
        
        if($this->request->request_method == "POST"){           
            $this->read_fields('post', 'Post');
            $this->posts= $this->servicioPost->posts_para_relaciones($filtro);
            $this->tags= $this->servicioTag->tags();
            if(! $this->validate($this->post)){
                $this->load_view("admin/post_add");
            }
            else{
                $this->post->autor= $usuario->id;
                $usuarioAdd= $this->servicioPost->agregar($this->post, $this->relaciones, $this->tags_rel);
                if($usuarioAdd){
                    $this->mensaje= "Agregado correctamente";
                    $this->posts= $this->servicioPost->posts_para_relaciones($filtro);
                    $this->post= new Post();
                    $this->load_view("admin/post_add");
                }
                else{
                    $this->mensaje_error= "Hubo un error agregando los datos";
                    $this->load_view("admin/post_add");
                }
            }
        }
        if($this->request->request_method == "GET"){
            $this->post= new Post();           
            $this->posts= $this->servicioPost->posts_para_relaciones($filtro);
            $this->tags= $this->servicioTag->tags();
            $this->load_view("admin/post_add");
        }
    }
    
    public function update(){        
        $usuario= $this->request->session->get_unserialize('usuario_session');        
        
        if($this->request->request_method == "POST"){
            $post_actual= $this->servicioPost->post($this->params[0]);
            $this->read_fields('post', 'Post');
            $filtro= array('id_usuario' => $usuario->id, 'id_excepto' => $this->post->id);
            $this->posts= $this->servicioPost->posts_para_relaciones($filtro);
            $this->tags= $this->servicioTag->tags();
            if(! $this->validate($this->post)){
                $this->load_view("admin/post_update");
            }
            else{
                $this->post->autor= $post_actual->autor;
                if($usuario->tipo_usuario == 'administrador'){
                    $usuarioMod= $this->servicioPost->modificar($this->post, $this->relaciones, $this->tags_rel);
                }
                else{
                    $usuarioMod= $this->servicioPost->modificar($this->post, $this->relaciones, $this->tags_rel, $usuario->id);
                }                
                if($usuarioMod){
                    $this->mensaje= "Modificado correctamente";                    
                    $this->post= $this->servicioPost->post($this->post->id);
                    $this->load_view("admin/post_update");
                }
                else{
                    $this->mensaje_error= "Hubo un error modificando los datos";
                    $this->load_view("admin/post_update");
                }
            }
        }
        if($this->request->request_method == "GET"){
            $this->post= $this->servicioPost->post($this->params[0]);
            if($usuario->tipo_usuario != 'administrador'){
                if($this->post->autor != $usuario->id){
                    exit;
                }
            }
            $filtro= array('id_usuario' => $usuario->id, 'id_excepto' => $this->post->id);
            $this->posts= $this->servicioPost->posts_para_relaciones($filtro);
            $this->relaciones= $this->servicioPost->id_relaciones($this->post->id);
            $this->tags= $this->servicioTag->tags();
            $this->tags_rel= $this->servicioPost->id_relaciones_tags($this->post->id);
            $this->load_view("admin/post_update");
        }
    }
    
    protected function read_fields($var_name, $class = NULL) {
        parent::read_fields($var_name, $class);
        if($this->request->param_post('habilitado') == NULL){
            $this->post->habilitado= 0;
        }
        $this->relaciones= $this->request->param_post('relacion');
        $this->tags_rel= $this->request->param_post('tags');
    }
    
    protected function config_validation() {
        $reglas= array('titulo' => 'required|min_length[5]|max_length[50]', 
            'descripcion' => 'required|min_length[30]|max_length[300]',
            'contenido' => 'required|min_length[50]');
        if($this->request->param_post('id') != NULL){
            $reglas['id']= 'required';
        }
        return $reglas;
    }
    
    protected function validate($var){
        if(parent::validate($var)){
            if($this->servicioPost->existe_post($this->post->titulo, $this->request->param_post('id'))){
                $this->errores['titulo']= "El post ya existe";
                return FALSE;
            }
            else{
                return TRUE;
            }
        }
        else{
            return FALSE;
        }
    }
}

?>
