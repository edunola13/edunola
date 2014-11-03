<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CerrarSesion
 *
 * @author Usuario_2
 */
class CerrarSesion extends En_Controller{
    
     public function doGet(){
        //Si esta logueado borro la sesion
        if($this->request->session->exist('user_logged')){
            $this->request->session->delete_session();
        }
        //Redirecciono al front
        redirect("");
    }
}

?>
