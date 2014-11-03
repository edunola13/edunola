<?php
/**
 * Clase de la que deben extender los controladores de la aplicacion para que se asegure el funcioneamiento del mismo
 * @author Enola
 */
class En_Controller extends Enola implements Controller{
    protected $request;     
    //errores
    public $errores;    
    /**
     * Constructor que carga las librerias y carga los parametros limpiandolos
     */
    function __construct(){
        $this->type= 'controller';
        $this->load_libraries();
        $this->request= En_HttpRequest::getInstance();
    }    
    /**
     * Funcion que es llamada cuando el metodo HTTP es GET
     */
    public function doGet(){        
    }    
    /**
     * Funcion que es llamada cuando el metodo HTTP es POST
     */
    public function doPost(){        
    }    
    /**
     * Funcion que es llamada cuando el metodo HTTP es DELETE
     */
    public function doDelete(){        
    }    
    /**
     * Funcion que es llamada cuando el metodo HTTP es PUT
     */
    public function doPut(){        
    }
    /**
     * Funcion que es llamada cuando el metodo HTTP es HEAD
     */
    public function doHead(){        
    }
    /**
     * Funcion que es llamada cuando el metodo HTTP es TRACE
     */
    public function doTrace(){        
    }
    /**
     * Funcion que es llamada cuando el metodo HTTP es OPTIONS
     */
    public function doOptions(){        
    }
    /**
     * Funcion que es llamada cuando el metodo HTTP es CONNECT
     */
    public function doConnect(){        
    }
    
    /**
     * Funcion lee los campos de un formulario
     */
    protected function read_fields(){        
    }    
    /**
     * Funcion que valido los campos de un formulario
     */
    protected function validate(){        
    }    
    /**
     * Funcion que actua cuando acurre un error en la validacion
     */
    protected function error(){        
    }    
    /**
     * Funcion que carga los datos usados por la vista
     */
    protected function load_data(){        
    }    
    /**
     * Funcion que carga los datos usados por la vista de 
     */
    protected function load_data_error(){        
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