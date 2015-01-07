<?php
/**
 * Description of Login
 *
 * @author Usuario_2
 */
/**
 * Importar 
 */
import_aplication_file("source/services/UsuarioServices");

class Login extends En_Controller{
    protected $mensaje;
    protected $usuario;
    
    public function doGet(){
        if($this->request->session->exist('user_logged')){
            redirect("admin");
        }
        else{
            $this->load_view("login");
        }
    }
    
    public function doPost(){
        if(! $this->request->session->exist('user_logged')){
            $this->read_fields('usuario');
            if(! $this->validate($this->usuario)){
                $this->load_view("login");
            }            
            else{
                $servicio= new UsuarioServices();
                $this->usuario= $servicio->iniciarSesion($this->usuario['usuario'], $this->usuario['clave']);
                if($this->usuario == NULL){
                    //Armo un mensaje de respuesta
                    $this->mensaje= 'El usuario o contraseña son invalidos';
                    //Lo mando al formulario con el mensaje
                    $this->load_view("login");
                }
                else{
                    //Seteo el valor de usuario a la sesion
                    $this->request->session->set_serialize('usuario_session', $this->usuario);
                    //Seteo el tipo de usuario
                    $this->request->session->set('user_logged', $this->usuario->tipo_usuario);
                    //Redirecciono al back
                    redirect("admin");
                }
            }
        }
        else{
            //Redirecciono al back
            redirect("admin");
        }
    }
    
    protected function validate($var) {
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('usuario', $var['usuario'], 'required|min_length[5]|max_length[20]');
        $validacion->add_rule('clave', $var['clave'], 'required|min_length[5]|max_length[20]');

        if(! $validacion->validate()){
            //Consigo los errores
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            return TRUE;
        }        
    }
}

?>
