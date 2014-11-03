<?php
/**
 * Description of Admin
 *
 * @author Usuario_2
 */
/**
 * Importar 
 */
import_aplication_file("source/services/UsuarioServices");

class Admin extends En_Controller{
    protected $usuario;
    protected $mensaje;
    
    protected $servicio;
    
    public function __construct() {
        parent::__construct();
        $this->servicio= new UsuarioServices();
    }
    
    public function index(){
        if($this->request->request_method == "GET"){
            $this->usuario= $this->request->session->get('usuario_session');
            $this->load_view("admin/index");
        }
        if($this->request->request_method == "POST"){
            $this->read_fields();
            if(! $this->validate()){
                $this->error();
            }
            else{
                $modClave= FALSE;
                if($this->request->param_post('clave') != ''){
                    $modClave= TRUE;
                }
                $usuarioMod= $this->servicio->modificar($this->usuario, $modClave);
                if($usuarioMod){
                    $this->mensaje= "Modificado correctamente";
                    $this->request->session->set('usuario_session', $usuarioMod);
                    $this->usuario= $this->request->session->get('usuario_session');
                    $this->load_view("admin/index");
                }
                else{
                    $this->mensaje= "Hubo un error modificando los datos";
                    $this->load_view("admin/index");
                }
            }
        }        
    }
    
    protected function read_fields() {
        $this->usuario= $this->servicio->usuario($this->request->param_post('id'));
        $this->usuario->usuario= $this->request->param_post('usuario');
        if($this->request->param_post('clave') != ''){
            $this->usuario->clave= $this->request->param_post('clave');
        }
        $this->usuario->nombre= $this->request->param_post('nombre');
        $this->usuario->email= $this->request->param_post('email');
        $this->usuario->fecha_nacimiento= $this->request->param_post('fecha_nacimiento');
    }
    
    protected function validate(){
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('id', $this->usuario->id, 'required');
        $validacion->add_rule('usuario', $this->usuario->usuario, 'required|min_length[5]|max_length[20]');
        if($this->request->param_post('clave') != ''){
            $validacion->add_rule('clave', $this->usuario->clave, 'required|min_length[5]|max_length[20]');
        }
        $validacion->add_rule('nombre', $this->usuario->nombre, 'required|min_length[10]|max_length[50]');
        $validacion->add_rule('email',  $this->usuario->email, 'email');
        $validacion->add_rule('fecha_nacimiento', $this->usuario->fecha_nacimiento, 'date[Y-m-d]');

        if(! $validacion->validate()){
            //Consigo los errores
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    protected function error() {
        $this->load_view("admin/index");
    }
}

?>
