<?php
/**
 * Description of Blog
 *
 * @author Enola
 */
/*
 * Importar
 */
import_aplication_file("source/services/PostServices");
import_aplication_file("source/services/TagServices");
import_aplication_file("source/services/ComentarioServices");
import_aplication_file("source/models/User");
class Blog extends En_Controller{
    protected $can_por_page= 3;
    protected $posts;
    protected $post;
    protected $posts_relacionados;
    protected $tags_relacionados;
    
    protected $comentario;
    
    protected $servicioPost;
    protected $servicioTag;
    
    public function __construct() {
        parent::__construct();
        $this->servicioPost= new PostServices();
        $this->servicioTag= new TagServices();
    }
    
    public function index(){
        $cantidad= $this->servicioPost->cant_posts_front();
        $paginador= new Paginator($this->can_por_page, $cantidad, 1);
        $this->posts= $this->servicioPost->posts_front($this->can_por_page);
        $this->load_view("blog/index", $paginador);
    }
    
    public function page(){
        $pagina= 1;
        if(isset($this->params[0])){
            $pagina= $this->params[0];
        }
        $cantidad= $this->servicioPost->cant_posts_front();
        $paginador= new Paginator($this->can_por_page, $cantidad, $pagina);
        if($paginador->number_of_pages() >= $pagina && $pagina > 0){
            $this->posts= $this->servicioPost->posts_front($this->can_por_page, $paginador->element_start_position());
            $this->load_view("blog/index", $paginador);
        }
        else{
            redirect('blog');
        }
    }
    
    public function search(){
        $find= "";
        if(isset($this->params[0])){
            $find= urldecode($this->params[0]);
        }
        $pagina= 1;
        if(isset($this->params[1])){
            $pagina= $this->params[1];
        }
        $cantidad= $this->servicioPost->cant_posts_search($find);
        $paginador= new Paginator($this->can_por_page, $cantidad, $pagina);
        if($paginador->number_of_pages() >= $pagina && $pagina > 0){
            $this->posts= $this->servicioPost->search_posts($find, $this->can_por_page, $paginador->element_start_position());
            $this->load_view("blog/search", array('paginador' => $paginador, 'find' => $find));
        }
        else{
            if($paginador->number_of_pages() == 0){
                $this->posts= array();
                $this->load_view("blog/search", array('paginador' => $paginador));
            }
            else{
                redirect('blog');
            }
        }
    }
    
    public function fecha(){
        if(isset($this->params[1]) && isset($this->params[0])){
            $mes= $this->params[0];
            $ano= $this->params[1];
            $this->posts= $this->servicioPost->fecha_posts($mes, $ano);
            $this->load_view("blog/posts_fecha");
        }
        else{
            redirect('blog');
        }        
    }
    
    public function tag(){
        if(isset($this->params[0])){
            $nombre= replace(' ', '-', urldecode($this->params[0]));
            $this->posts= $this->servicioPost->tag_posts($nombre);
            $this->load_view("blog/posts_tag");
        }
        else{
            redirect('blog');
        }        
    }
    
    public function post(){
        $titulo= "";
        if(isset($this->params[0])){
            $titulo= replace(' ', '-', urldecode($this->params[0]));
        }
        $this->post= $this->servicioPost->post_titulo($titulo);        
        if($this->post != NULL){
            if($this->post->habilitado == FALSE){
                $this->post= NULL;
            }
            else{
                $this->servicioPost->agregar_vista($this->post->id);
                $this->posts_relacionados= $this->servicioPost->posts_relacionados($this->post->id);
                $this->tags_relacionados= $this->servicioTag->tags_post($this->post->id);
            }
        }        
        $this->load_view("blog/post");
    }
    
    public function add_comentario(){
        if($this->request->request_method == 'POST'){
            $this->read_fields('comentario', 'Comentario');
            $rta= array();
            if(! $this->validate($this->comentario)){
                $rta= array('rta' => FALSE);
                $rta['errores']= 'Los Campos se encuentran mal completados';
            }
            else{
                $servicio= new ComentarioServices();
                $usuario= $this->request->session->get_unserialize('usuario_session');
                if($servicio->add_comentario($this->comentario, $usuario)){
                    $rta= array('rta' => TRUE);
                }
                else{
                    $rta= array('rta' => FALSE, 'errores' => 'Hubo un problema, vuelva a intentarlo');
                }                
            }
            echo json_encode($rta);
        }
    }
    
    public function delete_comentario(){
        if($this->request->request_method == 'GET'){
            $id= $this->params[0];
            $servicio= new ComentarioServices();
            if($servicio->update_comentario($id)){
                $rta= array('rta' => TRUE);
            }
            else{
                $rta= array('rta' => FALSE);
            }
            echo json_encode($rta);
        }
    }
    
    protected function config_validation() {
        $config= array('nombre' => 'required|max_length[25]',
            'comentario' => 'required|max_length[250]');
        return $config;
    }
}

?>
