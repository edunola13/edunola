<?php
/**
 * Clase de la que deben extender los filtros de la aplicacion para funcionar correctamente
 * @author Enola
 */
class En_Filter extends Enola implements Filter{
    protected $request;
    /**
     * Constructor que carga las librerias correspondientes
     */
    function __construct() {
        $this->type= 'filter';
        $this->load_libraries();
        $this->request= En_HttpRequest::getInstance();
    }    
    /**
     * Funcion que es llamada para realizar el filtro correspondiente
     */
    public function filter(){        
    }    
}
?>