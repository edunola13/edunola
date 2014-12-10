<?php
/**
 * Description of Tags
 *
 * @author Enola
 */
import_aplication_file('source/services/TagServices');
class TagsCon extends En_Controller{
    protected $tag;
    protected $tags;
    
    protected $tipo_mensaje;
    protected $mensaje;
    
    protected $servicio;
    
    public function __construct() {
        parent::__construct();
        $this->servicio= new TagServices();
    }
    
    public function index(){
        $this->tags= $this->servicio->tags();
        $this->load_view('admin/tags');
    }
    
    public function lista_tags(){
        $this->tags= $this->servicio->tags();
        $this->load_view('admin/sections_tag/tabla_tags');
    }
    
    public function add(){
        if($this->request->request_method == "GET"){
            $this->tag= new Tag();
            $this->load_view('admin/sections_tag/add_tag');
        }
        else{
            $this->read_fields();
            if(! $this->validate($this->tag)){
                $this->load_view('admin/sections_tag/add_tag');
            }
            else{                
                $agregado= $this->servicio->agregar($this->tag);
                if($agregado){
                    $this->tipo_mensaje= 'info';
                    $this->mensaje= "Agregado correctamente";
                    $this->tag= new Tag();
                    $this->load_view('admin/sections_tag/add_tag');
                }
                else{
                    $this->tipo_mensaje= 'danger';
                    $this->mensaje= "Hubo un error agregando los datos";
                    $this->load_view('admin/sections_tag/add_tag');
                }
            }
        }
    }
    
    public function update(){
        if($this->request->request_method == "GET"){
            $this->tag= $this->servicio->tag($_GET['id']);
            if($this->tag == NULL){
                exit;
            }
            $this->load_view('admin/sections_tag/update_tag');
        }
        else{
            $this->read_fields();
            if(! $this->validate($this->tag)){
                $this->load_view('admin/sections_tag/update_tag');
            }
            else{                
                $agregado= $this->servicio->modificar($this->tag);
                if($agregado){
                    $this->tipo_mensaje= 'info';
                    $this->mensaje= "Modificado correctamente";
                    $this->load_view('admin/sections_tag/update_tag');
                }
                else{
                    $this->tipo_mensaje= 'danger';
                    $this->mensaje= "Hubo un error modificando los datos";
                    $this->load_view('admin/sections_tag/update_tag');
                }
            }
        }
    }
    
    public function delete(){
        $id= $this->request->param_post('id');
        if($id != NULL){
            if(! $this->servicio->tiene_post($id)){
                if($this->servicio->eliminar($id)){
                    $this->tipo_mensaje= 'info';
                    $this->mensaje= 'Eliminado Correctamente';
                }
                else{
                    $this->tipo_mensaje= 'danger';
                    $this->mensaje= 'Hubo un error eliminando los datos';
                }
            }
            else{
                $this->tipo_mensaje= 'warning';
                $this->mensaje= 'El Tag tiene posts asociados y no se pueden eliminar';
            }
            $this->tags= $this->servicio->tags();
            $this->load_view('admin/sections_tag/tabla_tags');
        }
    }
    
    public function read_fields() {
        parent::read_fields('tag', 'Tag');
    }
    
    public function config_validation() {
        $reglas= array('nombre' => 'required|max_length[20]', 'descripcion' => 'required|min_length[10]|max_length[250]');
        if($this->request->param_post('id') != NULL){
            $reglas['id']= 'required';
        }
        return $reglas;
    }
    
    public function validate($object) {
        if(parent::validate($object)){
            if($this->servicio->existe_tag($this->tag->nombre, $this->tag->id)){
                $this->errores['nombre']= 'El nombre de Tag ya existe';
                return FALSE;
            }
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}

?>
