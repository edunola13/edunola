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
        $this->usuario= new Usuario();
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
                    $this->usuario= new Usuario();
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
                $usuario= $this->servicio->usuario($id);
                if($usuario->usuario == 'eduardo_n'){
                    $rta= FALSE;
                }
                else{
                    $rta= $this->servicio->eliminar($id); 
                }                              
                if($rta){
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
        $id= $this->request->session->get('usuario_session')->id;
        $this->usuarios= $this->servicio->usuarios($id);
    }
    
    protected function read_fields() {
        if($this->request->param_post('id') != NULL){
            $this->usuario= $this->servicio->usuario($this->request->param_post('id'));
        }
        else{
            $this->usuario= new Usuario();
        }
        $this->usuario->usuario= $this->request->param_post('usuario');
        if($this->request->param_post('id') == NULL){
            $this->usuario->clave= $this->request->param_post('clave');
        }
        else{
            if($this->request->param_post('clave') != ''){
                $this->usuario->clave= $this->request->param_post('clave');                
            }
        }
        $this->usuario->nombre= $this->request->param_post('nombre');
        $this->usuario->email= $this->request->param_post('email');
        $this->usuario->fecha_nacimiento= $this->request->param_post('fecha_nacimiento');
        $this->usuario->habilitado= $this->request->param_post('habilitado');
        if(! $this->usuario->habilitado == 1){
            $this->usuario->habilitado= 0;
        }
        $this->usuario->tipo_usuario= $this->request->param_post('tipo');
    }
    
    protected function validate(){
        //Valido los campos del form
        $validacion= new Validation();
        if($this->request->param_post('id') != ''){
            $validacion->add_rule('id', $this->usuario->id, 'required');
        }
        $validacion->add_rule('usuario', $this->usuario->usuario, 'required|min_length[5]|max_length[20]');
        if($this->request->param_post('id') == NULL){
            $validacion->add_rule('clave', $this->usuario->clave, 'required|min_length[5]|max_length[20]');
        }
        else{
            if($this->request->param_post('clave') != ''){
                $validacion->add_rule('clave', $this->usuario->clave, 'required|min_length[5]|max_length[20]');
            }
        }
        $validacion->add_rule('nombre', $this->usuario->nombre, 'required|min_length[10]|max_length[50]');
        $validacion->add_rule('email',  $this->usuario->email, 'email');
        $validacion->add_rule('fecha_nacimiento', $this->usuario->fecha_nacimiento, 'date[Y-m-d]');
        $validacion->add_rule('tipo', $this->usuario->tipo_usuario, 'required');

        if(! $validacion->validate()){
            //Consigo los errores
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            if($this->servicio->existe_usuario($this->usuario->usuario, $this->request->param_post('id'))){
                $this->errores['usuario']= "El usuario ya existe";
                return FALSE;
            }
            else{
                if($this->request->param_post('id') != NULL){
                    $usuario_mod= $this->servicio->usuario($this->usuario->id);
                    if($usuario_mod->usuario == 'eduardo_n'){
                        $this->errores['usuario']= "Usuario Incorrecto";
                        return FALSE;
                    }
                }
                return TRUE;
            }            
        }
    }
    
    protected function error(){
        $this->load_data();
        $this->load_view("admin/usuarios");
    }
}

?>
