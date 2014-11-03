<?php
    /**
     * Importa todo lo necesario para manejar los componentes
     * Contiene funciones para manejar los componentes por el framework y por el usuario
     */
    //Interface y Clase de la que deben extender todos los components
    require PATHFRA . 'classes/Component.php';
    require PATHFRA . 'classes/En_Component.php';
    /**
     * Ejecuta el metodo renderizar de un componente
     * @param type $nombre
     * @param type $parametros
     */ 
    function execute_component($nombre, $parametros = NULL){
        $componente= NULL;
        if(isset($GLOBALS['componentes'][$nombre])){
            $comp= $GLOBALS['componentes'][$nombre];
            $dir= "";
            if(! isset($comp['location'])){
                $dir= PATHAPP . 'source/components/' . $comp['class'] . '.php';
            }
            else{
                $dir= PATHAPP . $comp['location'] . '/' . $comp['class'] . '.php';
            }
            require $dir;
            $dir= explode("/", $comp['class']);
            $class= $dir[count($dir) - 1];
            $componente= new $class();
        }
        if($componente != NULL){
            //Analiza si existe el metodo filtrar
            if(method_exists($componente, 'rendering')){
                if($parametros == NULL){
                    return $componente->rendering();
                }
                else{
                    return $componente->rendering($parametros);
                }
            }
            else{
                general_error('Component Error', 'The component ' . $nombre . ' dont implement the method rendering()');
            }          
        }
        else{
            general_error('Component Error', "The component $nombre dont exists");
        }
    }
?>