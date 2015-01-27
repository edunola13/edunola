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
        $this->read_fields('email');
        if(! $this->validate($this->email)){
            $this->error();
        }
        else{
            //Los campos son correctos, armo el mail
            $correo= "edunola13@hotmail.com";
            $asunto = $this->email['asunto'];
            $cuerpo = "Nombre: ". $this->email['nombre']. "<br/>" . "Email:". $this->email['email']. "<br/>" . $this->email['mensaje'];
            
            import_librarie('PHPMailer/class.phpmailer');            
            
            $mail = new PHPMailer();
            $mail->IsSMTP();  // telling the class to use SMTP  	
            //$mail->SMTPDebug = 2;
            
  	    $mail->Host     = "smtp.live.com";
            $mail->SMTPAuth      = true;
            $mail->SMTPSecure    = 'tls';
            $mail->Port          = 587;
            $mail->Username      = "edunola13@hotmail.com"; // SMTP account username
            $mail->Password      = "Anabella89$";

            $mail->SetFrom($correo, $asunto);
            $mail->SetFrom($correo, $asunto);
//            $mail->Host     = "smtp.gmail.com";
//            $mail->SMTPAuth      = true;
//            $mail->SMTPSecure    = 'ssl';
//            $mail->Port          = 465;
//            $mail->Username      = "anabelladigrazia@gmail.com"; // SMTP account username
//            $mail->Password      = "Lucia2013";
//
//            $mail->SetFrom('anabelladigrazia@gmail.com', 'Secretaría de Transporte - Resolucion 939 [NO-REPLY]');
//            $mail->SetFrom('anabelladigrazia@gmail.com', 'Resolucion 939 [NO-REPLY]');
            
            $mail->AddAddress($correo);
				
            $mail->Subject  = utf8_decode($asunto);
            $mail->AltBody = 'Use un visor compatible con HTML';
            $mail->MsgHTML(utf8_decode($cuerpo));		
            $mail->WordWrap = 50;
            set_time_limit(200);
            $resultado;
            if(!$mail->Send()) {
                //echo 'Message was not sent.';
                //echo 'Mailer error: ' . $mail->ErrorInfo;
                $resultado= FALSE;
            } else {
		//echo 'Message has been sent.';
		$resultado= TRUE;			
            }
		
            set_time_limit(30);
            //Ve si se pudo o no enviar el mail y en base a eso arma una respuesta
            if ($resultado) {
                $this->mensaje= "El correo fue enviado correctamente.";
                $this->email= NULL;
            }
            else{
                $this->mensaje= "El correo no pudo ser enviado. Por favor, vuelva a intentarlo.";
            }
            $this->load_view("contacto");
        }
    }
    
    public function validate($var) {
        //Valido los campos del form
        $validacion= new Validation();
        $validacion->add_rule('nombre', $var['nombre'], 'required');
        $validacion->add_rule('email', $var['email'], 'email');
        $validacion->add_rule('asunto', $var['asunto'], 'required');
        $validacion->add_rule('mensaje', $var['mensaje'], 'required');
            
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
