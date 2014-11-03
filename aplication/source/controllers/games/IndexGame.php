<?php
/**
 * Description of Index
 *
 * @author Usuario_2
 */
class IndexGame extends En_Controller{
    
    public function index(){
        $this->load_view("games/index");
    }
    
    public function desarrollos(){
        $this->load_view("games/desarrollos");
    }
    
    public function tecnologias(){
        $this->load_view("games/tecnologias");
    }
}
?>
