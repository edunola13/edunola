<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UiServices
 *
 * @author Usuario_2
 */
class UiServices extends En_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function doGet(){
        $this->load_view("uiservices");
    }
}
?>
