<?php
/**
 * Description of Image
 *
 * @author Enola
 */
/*
 * Importar
 */
import_aplication_file("source/services/ImageServices");
class Images extends En_Controller{
    protected $can_por_page= 3;
    
    protected $nombre;
    
    protected $mensaje;
    protected $mensaje_error;
    
    protected $servicioImagen;   
    
    public function __construct() {
        parent::__construct();
        $this->servicioImagen= new ImageServices();
    }
    
    public function search(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        
        $find= "";
        if(isset($this->params[0])){
            $find= urldecode($this->params[0]);
        }
        $pagina= 1;
        if(isset($this->params[1])){
            $pagina= $this->params[1];
        }
        $cantidad= $this->servicioImagen->cant_images_search($find);
        $paginador= new Paginator($this->can_por_page, $cantidad, $pagina);
        if($paginador->number_of_pages() >= $pagina && $pagina > 0){
            $this->imagenes= $this->servicioImagen->search_images($find, $this->can_por_page, $paginador->element_start_position());
            $this->load_view("admin/sections_post/search", array('paginador' => $paginador, 'find' => $find));
        }
        else{
            $this->load_view("admin/sections_post/search");
        }
    }
    
    public function add(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        
        $this->load_data();
        if(! $this->validate()){
            $this->load_view("admin/sections_post/rta_image");
        }
        else{
            $imagenAdd= move_uploaded_file($_FILES['imagen']['tmp_name'], PATHAPP . '/../resources/images/' . $this->nombre . '.jpg');
            if($imagenAdd){
                $imagen= new Image();
                $imagen->nombre= $this->nombre;            
                $imagenAdd= $this->servicioImagen->agregar($imagen);
            }
            if($imagenAdd){
                $this->mensaje= "Se ha agregado correctamente.";
                $this->load_view("admin/sections_post/rta_image");
            }
            else{
                $this->mensaje_error= "No se ha podido agregar correctamente.";
                $this->load_view("admin/sections_post/rta_image");
            }
        }        
    }
    
    protected function load_data(){
        $this->nombre= $this->request->param_post('nombre');
    }
    
    protected function validate($var) {
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('nombre', $this->nombre, 'required');

        if(! $validacion->validate()){
            //Consigo los errores            
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            //Creo que el tamano es un MG
            if($_FILES['imagen']['type'] != 'image/jpeg' || $_FILES['imagen']['size'] > 1200000){
                $this->errores['imagen']= 'La imagen debe ser de tipo image/jpeg y tener tamaño menor a 1200000';
                return FALSE;
            }
            if($this->servicioImagen->existe_imagen($this->nombre)){
                $this->errores['nombre']= "Ya existe una imagen con ese nombre";
                return FALSE;
            }
            //Comprobar que no exista el nombre
            return TRUE;           
        }
    }
}

?>