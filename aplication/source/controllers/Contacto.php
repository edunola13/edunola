<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contacto
 *
 * @author Usuario_2
 */
class Contacto extends En_Controller{
    protected $email;    
    protected $mensaje;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function doGet(){
        $this->load_view("contacto");
    }
    
    public function doPost(){
        $this->read_fields();
        if(! $this->validate()){
            $this->error();
        }
        else{
            //Los campos son correctos, armo el mail
            $correo= "edunola13@hotmail.com";
            $asunto = $this->email['asunto'];
            $cuerpo = "Nombre: ". $this->email['nombre']. "\n" . "Email:". $this->email['email']. "\n" . $this->email['mensaje'];
                
            //Modifico el header para poner como from y reply to al mail del consultante
            $headers = 'From: '.  $this->email['email']."\r\n".
            'Reply-To: '.  $this->email['email']."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $resultado = mail($correo, $asunto, $cuerpo, $headers);
                
            //Ve si se pudo o no enviar el mail y en base a eso arma una respuesta
            if ($resultado) {
                $this->mensaje= "El correo fue enviado correctamente.";
                unset($this->email);
            }
            else{
                $this->mensaje= "El correo no pudo ser enviado. Por favor, vuelva a intentarlo.";
            }
            $this->load_view("contacto");
        }
    }
    
    public function read_fields() {
        //Consigo los campos del form
        $this->email['nombre'] = $this->request->param_post('nombre');
        $this->email['email'] = $this->request->param_post('email');
        $this->email['asunto'] = $this->request->param_post('asunto');
        $this->email['mensaje'] = $this->request->param_post('mensaje');
    }
    
    public function validate() {
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('nombre', $this->email['nombre'], 'length_between[2&6]');
        $validacion->add_rule('email', $this->email['email'], 'email');
        $validacion->add_rule('asunto', $this->email['asunto'], 'required');
        $validacion->add_rule('mensaje', $this->email['mensaje'], 'required');
            
        if(! $validacion->validate()){
            $this->errores= $validacion->error_messages();
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    public function error() {
        $this->load_view("contacto");
    }
}
?>
