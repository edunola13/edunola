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

class Posts extends En_Controller{
    protected $posts;
    protected $post;
    protected $relaciones;
    protected $cant_por_pagina= 10;
    
    protected $mensaje;
    protected $mensaje_error;
    
    protected $servicioPost;   
    
    public function __construct() {
        parent::__construct();
        $this->servicioPost= new PostServices();
    }
    
    public function index(){
        $usuario= $this->request->session->get('usuario_session');
        $filtro= array('id_usuario' => $usuario->id);
        
        $cantidad= $this->servicioPost->cant_posts($filtro);
        $paginador= new Paginator($this->cant_por_pagina, $cantidad, 1);
        $this->posts= $this->servicioPost->posts($filtro, $this->cant_por_pagina);
        $this->load_view('admin/posts', $paginador);
    }
    
    public function page(){
        $usuario= $this->request->session->get('usuario_session');
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
            $usuario= $this->request->session->get('usuario_session');
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
        $usuario= $this->request->session->get('usuario_session');
        $filtro= array('id_usuario' => $usuario->id, 'habilitado' => TRUE);
        
        if($this->request->request_method == "POST"){
            $this->read_fields();
            $this->posts= $this->servicioPost->posts($filtro);
            if(! $this->validate()){
                $this->load_view("admin/post_add");
            }
            else{
                $this->post->autor= $this->request->session->get('usuario_session')->id;
                $usuarioAdd= $this->servicioPost->agregar($this->post, $this->relaciones);
                if($usuarioAdd){
                    $this->mensaje= "Agregado correctamente";
                    $this->posts= $this->servicioPost->posts($filtro);
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
            $this->posts= $this->servicioPost->posts($filtro);
            $this->load_view("admin/post_add");
        }
    }
    
    public function update(){
        $usuario= $this->request->session->get('usuario_session');        
        
        if($this->request->request_method == "POST"){            
            $this->read_fields();
            $filtro= array('id_usuario' => $usuario->id, 'excepto_id' => $this->post->id, 'habilitado' => TRUE);
            $this->posts= $this->servicioPost->posts($filtro);
            if(! $this->validate()){
                $this->load_view("admin/post_update");
            }
            else{
                if($usuario->tipo_usuario == 'administrador'){
                    $usuarioMod= $this->servicioPost->modificar($this->post, $this->relaciones);
                }
                else{
                    $usuarioMod= $this->servicioPost->modificar($this->post, $this->relaciones, $usuario->id);
                }
                
                if($usuarioMod){
                    $this->mensaje= "Modificado correctamente";                    
                    $this->post= $this->servicioPost->post($usuarioMod->id);
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
            $filtro= array('id_usuario' => $usuario->id, 'excepto_id' => $this->post->id, 'habilitado' => TRUE);
            $this->posts= $this->servicioPost->posts($filtro);
            $this->relaciones= $this->servicioPost->id_relaciones($this->post->id);
            $this->load_view("admin/post_update");
        }
    }
    
    protected function read_fields() {
        if($this->request->param_post('id') != NULL){
            $this->post= $this->servicioPost->post($this->request->param_post('id'));
        }
        else{
            $this->post= new Post();
        }
        $this->post->titulo= $this->request->param_post('titulo');
        $this->post->descripcion= $this->request->param_post('descripcion');
        $this->post->contenido= $this->request->param_post('contenido');
        $this->post->habilitado= $this->request->param_post('habilitado');
        if(! $this->post->habilitado == 1){
            $this->post->habilitado= 0;
        }
        $this->relaciones= $this->request->param_post('relacion');
    }
    
    protected function validate(){
        //Valido los campos del form
        $validacion= new Validation();
        if($this->request->param_post('id') != ''){
            $validacion->add_rule('id', $this->post->id, 'required');
        }
        $validacion->add_rule('titulo', $this->post->titulo, 'required|min_length[5]|max_length[50]');
        $validacion->add_rule('descripcion', $this->post->descripcion, 'required|min_length[30]|max_length[300]');
        $validacion->add_rule('contenido', $this->post->contenido, 'required|min_length[50]');

        if(! $validacion->validate()){
            //Consigo los errores
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            if($this->servicioPost->existe_post($this->post->titulo, $this->request->param_post('id'))){
                $this->errores['titulo']= "El post ya existe";
                return FALSE;
            }
            else{
                return TRUE;
            }            
        }
    }
}

?>
