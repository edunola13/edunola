<?php
/**
 * Description of Login
 *
 * @author Usuario_2
 */
class Login extends En_Controller{
    
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
            $user;
            $this->read_fields($user);
            if(! $this->validate($user)){
                $this->load_view("login", array('user' => $user));
            }            
            else{
                if($user['user'] != "admin" || $user['password'] != "admin"){
                    //Armo un mensaje de respuesta
                    $this->mensaje= 'El usuario o contraseña son invalidos';
                    //Lo mando al formulario con el mensaje
                    $this->load_view("login", array('user' => $user));
                }
                else{
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
