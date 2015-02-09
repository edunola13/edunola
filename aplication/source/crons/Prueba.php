<?php
/**
 * Description of Prueba
 *
 * @author Usuario_2
 */
class Prueba extends En_CronController{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        import_aplication_file('source/services/TagServices');
        $tag= new Tag();
        $tag->descripcion= 'adadsd';
        $tag->nombre= 'sdad';
        $servicio= new TagServices();
        $servicio->agregar($tag);       
    }
}

?>
