<?php
    /**
     * Importa todo lo necesario para manejar las BD
     * Contiene funciones para manejar la BD por el framework y por el usuario
     */
    //Clase de la que deben extender todas las clases que quieran manejar la BD con el framework implicitamente
    require PATHFRA . 'classes/En_DataBase.php';    
    /**
     * Funcion que conecta a una BD y retorna la conexion
     * @return \PDO
     */
    function conect_bd(){
        //Si ya esta seteada quiere decir que ya se conecto a la BD en otro momento
        if(! isset($GLOBALS['gbd'])){
            //Leo archivo de configuracion de BD
            if(defined('JSON_CONFIG_BD')){
                $json_basededatos= file_get_contents(PATHAPP . CONFIGURATION . JSON_CONFIG_BD);
            }
            else {
                general_error('Data Base', 'The configuration file of the Data Base is not especified', 'error_bd');
            }
            $config_bd= json_decode($json_basededatos, TRUE);
            //Consulta la bd actual
            $opcion= $config_bd['actual_db'];
            //Cargo las opciones de la bd actual
            $cbd= $config_bd[$opcion];
            //Abro una conexion
            try {
                // 5.3.5 o < y luego 5.3.6 o >
                //Cuidado que charset=utf8 puede no funcar para versiones viejas y luego en opciones
                //superiores habria q usar PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                //Por ahora uso las 2 y anda la que anda
                //Creo el dsn
                $dsn=  $cbd['driverbd'].':host='.$cbd['hostname'].';dbname='.$cbd['database'].';charset='.$cbd['charset'];
                //Abro la conexion
                
                $gbd = new PDO($dsn, $cbd['user'], $cbd['pass'], array(PDO::ATTR_PERSISTENT => $cbd['persistente'], PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$cbd['charset']));
                $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                //Guarda la conexion en un variable global
                $GLOBALS['gbd']= $gbd;
                //Retorno la conexion 
                return $gbd;
            } 
            catch (PDOException $e) {
                general_error('Conexion Error', $e->getMessage(), 'error_bd');
            }
        }
        else{
            return $GLOBALS['gbd'];
        }
    }    
    /**
     * Realiza la conexion a la BD para la implementacion del patron Active Record
     */
    function conect_bd_ar(){
        //Leo archivo de configuracion de BD
        if(defined('JSON_CONFIG_BD')){
            $json_basededatos= file_get_contents(PATHAPP . CONFIGURATION . JSON_CONFIG_BD);
        }
        else {
            general_error('Data Base', 'The configuration file of the Data Base is not especified', 'error_bd');
        }
        $config_bd= json_decode($json_basededatos, TRUE);
        //Consulta la bd actual
        $bd_actual= $config_bd['actual_db'];
        unset($config_bd['actual_db']);        
        try{
            $cfg = ActiveRecord\Config::instance();            
            $cfg->set_model_directory(PATHAPP . 'source/models');

            $conexiones= array();
            foreach ($config_bd as $key => $conexion) {
                $conexiones["$key"]= ''.$conexion['driverbd'].'://'.$conexion['user'].':'.$conexion['pass'].'@'.$conexion['hostname'].'/'.$conexion['database'].'?charset='.$conexion['charset'].'';
            }     
            $cfg->set_connections($conexiones);
            $cfg->set_default_connection($bd_actual);            
            
            ActiveRecord\DateTime::$DEFAULT_FORMAT = 'Y-m-d';
        }
        catch(Exception $e){
            general_error('Conexion Error', $e->getMessage(), 'error_bd');
        }        
    }    
    /**
     * Cierra la conexion a la BD
     */
    function close_conexion_bd(){
        if(isset($gbd)){
            unset($gbd);
        }
        if(isset($GLOBALS['gbd'])){
            unset($GLOBALS['gbd']);
        }
    }
?>