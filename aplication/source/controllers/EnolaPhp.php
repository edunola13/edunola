<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnolaPhp
 *
 * @author Usuario_2
 */
class EnolaPhp extends En_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function doGet(){
        $this->load_view("enolaphp");
    }
}
?>
