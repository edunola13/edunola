<?php
/**
 * Description of ImageDao
 *
 * @author Enola
 */
import_aplication_file('source/models/Image');
class ImageDao extends En_DataBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function search_images($find, $limit = 0, $offset = 0){
        $consulta= $this->conexion->prepare('SELECT * FROM image WHERE nombre LIKE :find order by nombre desc limit ' . $limit . ' offset ' . $offset);
        $consulta->execute(array(':find' => '%'.$find.'%'));
        return $this->results_in_objects($consulta, 'Image');
    }
    
    public function cant_search_images($find){
        $consulta= $this->conexion->prepare('SELECT count(*) as cant FROM image WHERE nombre LIKE :find');
        $consulta->execute(array(':find' => '%'.$find.'%'));
        $resultado= $consulta->fetchObject();
        return $resultado->cant;
    }
    
    public function imagen($nombre){
        $consulta= $this->conexion->prepare('SELECT * FROM image WHERE nombre = :nombre');
        $consulta->execute(array(':nombre' => $nombre));
        return $this->first_result_in_object($consulta, 'Image');
    }
    
    public function agregar($image){
        return $this->add_object('image', $image);
    }
}

?>
