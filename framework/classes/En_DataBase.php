<?php
/**
 * Clase que se encarga de la configuracion de la BD.
 * Para utilizar la configuracion del Framework es necesario que las clases extiendan de esta clase
 * @author Enola
 */
class En_DataBase extends Enola{
    protected $conexion;    
    /**
     * Constructor que conecta a la bd y carga las librerias que se indicaron en el archivo de configuracion
     */
    function __construct($conect = TRUE) {
        parent::__construct('db');
	if($conect){
            $this->conexion= $this->get_conexion();
	}
    }
    
    private function get_conexion(){
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
            $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Guarda la conexion en un variable global
            $GLOBALS['gbd']= $gbd;
            //Retorno la conexion 
            return $gbd;
        } 
        catch (PDOException $e) {
                general_error('Conexion Error', $e->getMessage(), 'error_bd');
        }
    }
    
    private function close_conexion(){
        $this->conexion= NULL;
    }
    
    protected function results_in_objects($PdoStatement, $class){
        $result= array();
        while($reg= $PdoStatement->fetchObject()){
            $instanciaClase= new $class();
            foreach ($reg as $key => $value) {
                $instanciaClase->$key= $value;
            }
            $result[]= $instanciaClase;
        }
        return $result;
    }
    
    protected function first_result_in_object($PdoStatement, $class){
        $tupla= $PdoStatement->fetchObject();
        if($tupla == NULL){
            return NULL;
        }
        else{
            $instanciaClase= new $class();
            foreach ($tupla as $key => $value) {
                $instanciaClase->$key= $value;
            }
            return $instanciaClase;
        }
    }
   
    protected function add_object($table, $object, $excepts_vars = array()){
        $vars= get_object_vars($object);
        $vars= $this->delete_vars($vars, $excepts_vars);
        $sql= 'INSERT INTO ' . $table . ' (';
        foreach ($vars as $key => $value) {
            $sql .= $key . ',';
        }
        $sql = trim($sql, ',');
        $sql .= ') values(';
        foreach ($vars as $key => $value) {
            $sql .= ':' . $key . ',';
        }
        $sql = trim($sql, ',');
        $sql .= ')';
        $consulta= $this->conexion->prepare($sql);
        foreach ($vars as $key => $value) {
            if($value === FALSE){
                $consulta->bindValue($key, 0);
            }
            else{
                $consulta->bindValue($key, $value);
            }
        }
        $consulta->execute();
        $error= $consulta->errorInfo();
        if($error[0] == ''){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    protected function update_object($table, $object, $where = '', $where_values = array(), $excepts_vars = array()){
        $vars= get_object_vars($object);
        $vars= $this->delete_vars($vars, $excepts_vars);
        $sql= 'UPDATE ' . $table . ' SET ';
        foreach ($vars as $key => $value) {
            $sql .= $key . '=:' . $key . ',';
        }
        $sql = trim($sql, ',');
        if($where != ''){
            $sql .= ' WHERE ' . $where;
        }
        $consulta= $this->conexion->prepare($sql);
        foreach ($vars as $key => $value){
            if($value === FALSE){
                $consulta->bindValue($key, 0);
            }
            else{
                $consulta->bindValue($key, $value);
            }
        }
        foreach ($where_values as $key => $value){
            if($value === FALSE){
                $consulta->bindValue($key, 0);
            }
            else{
                $consulta->bindValue($key, $value);
            }
        }
        $consulta->execute();
        $error= $consulta->errorInfo();
        if($error[0] == ''){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
     private function delete_vars($vars, $excepts_vars){
        foreach ($excepts_vars as $key => $value) {
            unset($vars[$value]);
        }
        return $vars;
    }
}
?>