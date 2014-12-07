<?php
/**
 * Description of Usuarios
 *
 * @author Usuario_2
 */
/**
 * Importar 
 */
import_aplication_file("source/services/UsuarioServices");
import_aplication_file('source/models/User');
class Usuarios extends En_Controller{
    protected $usuarios;
    protected $usuario;
    protected $mensaje;
    protected $mensaje_error;
    
    protected $servicio;
    
    public function __construct() {
        parent::__construct();
        $this->servicio= new UsuarioServices();
    }
    
    public function index(){
        $this->usuario= new User();
        $this->load_data();
        $this->load_view("admin/usuarios");
    }
    
    public function add(){
        if($this->request->request_method == "POST"){
            $this->read_fields();
            if(! $this->validate()){
                $this->error();
            }
            else{                
                $usuarioMod= $this->servicio->agregar($this->usuario);
                if($usuarioMod){
                    $this->mensaje= "Agregado correctamente";
                    $this->usuario= new User();
                    $this->load_data();
                    $this->load_view("admin/usuarios");
                }
                else{
                    $this->mensaje_error= "Hubo un error agregando los datos";
                    $this->load_data();
                    $this->load_view("admin/usuarios");
                }
            }
        }
        else{
            redirect('admin/usuarios');
        }
    }
    
    public function update(){
        if($this->request->request_method == "GET"){
            if($this->request->param_get('id') != NULL){
                $this->usuario= $this->servicio->usuario($this->request->param_get('id'));
                $this->load_view("admin/sections_user/form_update_usuarios");
            }
            else{
                redirect('admin/usuarios');
            }
        }
        if($this->request->request_method == "POST"){
            $this->read_fields();
            if(! $this->validate()){
                $this->load_data();
                $this->load_view("admin/usuarios", "update");
            }
            else{
                $modClave= FALSE;
                if($this->request->param_post('clave') != ''){
                    $modClave= TRUE;
                }
                $usuarioMod= $this->servicio->modificar($this->usuario, $modClave);
                if($usuarioMod){
                    $this->mensaje= "Modificado correctamente";
                }
                else{
                    $this->mensaje_error= "Hubo un error modificando los datos";
                }
                $this->load_data();
                $this->load_view("admin/usuarios", "update");
            }
        }
    }
    
    public function delete(){
        if($this->request->request_method == "POST"){
            if($this->request->param_post('id') != NULL){
                $id= $this->request->param_post('id');
                if($this->servicio->eliminar($id)){
                    $this->mensaje= "El usuario fue eliminado correctamente.";
                }
                else{
                    $this->mensaje= "Hubo un error eliminando el usuario.";
                }
                $this->load_data();
                $this->load_view("admin/sections_user/tabla_usuarios");
            }
        }
    }
    
    protected function load_data() {
        $id= $this->request->session->get_unserialize('usuario_session')->id;
        $this->usuarios= $this->servicio->usuarios($id);
    }
    
    protected function read_fields() {
        parent::read_fields('usuario', 'User');
        if($this->request->param_post('habilitado') == NULL){
            $this->usuario->habilitado= 0;
        }
    }
    
    protected function config_validation() {
        $reglas= array('usuario' => 'required|min_length[5]|max_length[20]', 'nombre' => 'required|min_length[10]|max_length[50]',
            'email' => 'email', 'fecha_nacimiento' => 'date[Y-m-d]', 'tipo_usuario' => 'required');
        if($this->request->param_post('id') != NULL){
            $reglas['id']= 'required';
        }
        if($this->request->param_post('id') == NULL){
            $reglas['clave']= 'required|min_length[5]|max_length[20]';
        }
        else{
            if($this->request->param_post('clave') != ''){
                $reglas['clave']= 'required|min_length[5]|max_length[20]';
            }
        }
        return $reglas;
    }
    
    protected function validate(){
        if(parent::validate($this->usuario)){
            if($this->servicio->existe_usuario($this->usuario->usuario, $this->usuario->id)){
                $this->errores['usuario']= "El usuario ya existe";
                return FALSE;
            }
            else{
                if($this->usuario->id != NULL){
                    $usuario_mod= $this->servicio->usuario($this->usuario->id);
                    if($usuario_mod->usuario == 'eduardo_n'){
                        $this->errores['usuario']= "Usuario Incorrecto";
                        return FALSE;
                    }
                }
                return TRUE;
            }
        }
        else{
            return FALSE;
        }
    }

    protected function error(){
        $this->load_data();
        $this->load_view("admin/usuarios");
    }
}
?>