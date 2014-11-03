<?php
/**
 * Description of Informacion
 *
 * @author Usuario_2
 */
class Informacion extends En_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function doGet(){
        $this->load_view("informacion");
    }
}

?>
