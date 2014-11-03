<?php
/**
 * @author Enola
 */
class En_Component extends Enola implements Component{    
    public function __construct() {
        $this->type= 'component';
        $this->load_libraries();
    }    
    /**
     * Funcion que es llamada para que el componente realice su trabajo
     */
    public function rendering($params = NULL){        
    }
    
    /**
     * Carga una vista PHP
     * @param type $view 
     */
    protected function load_view($view, $params = NULL){
        include PATHAPP . 'source/view/' . $view . '.php';
    }
}
?>
