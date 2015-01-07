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
            $this->usuario= $this->request->session->get_unserialize('usuario_session');
            $this->load_view("admin/index");
        }
        if($this->request->request_method == "POST"){
            $this->read_fields('usuario', 'User');
            if(! $this->validate($this->usuario)){
                $this->error();
            }
            else{
                $modClave= FALSE;
                if($this->request->param_post('clave') != ''){
                    $modClave= TRUE;
                }
                unset($this->usuario->habilitado);
                unset($this->usuario->tipo_usuario);
                $usuarioMod= $this->servicio->modificar($this->usuario, $modClave);
                if($usuarioMod){
                    $this->mensaje= "Modificado correctamente";
                    $this->request->session->set_serialize('usuario_session', $usuarioMod);
                    $this->usuario= $this->request->session->get_unserialize('usuario_session');
                    $this->load_view("admin/index");
                }
                else{
                    $this->mensaje= "Hubo un error modificando los datos";
                    $this->load_view("admin/index");
                }
            }
        }        
    }
    
    protected function validate($var){
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('id', $var->id, 'required');
        $validacion->add_rule('usuario', $var->usuario, 'required|min_length[5]|max_length[20]');
        if($this->request->param_post('clave') != ''){
            $validacion->add_rule('clave', $var->clave, 'required|min_length[5]|max_length[20]');
        }
        $validacion->add_rule('nombre', $var->nombre, 'required|min_length[10]|max_length[50]');
        $validacion->add_rule('email',  $var->email, 'email');
        $validacion->add_rule('fecha_nacimiento', $var->fecha_nacimiento, 'date[Y-m-d]');

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
