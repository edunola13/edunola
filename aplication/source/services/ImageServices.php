<?php
/**
 * Description of ImageServices
 *
 * @author Enola
 */
import_aplication_file('source/models/ImageDao');
class ImageServices {
    protected $dao;
    public function __construct() {
        $this->dao= new ImageDao();
    }
    
    public function search_images($find, $limit = 0, $offset = 0){
        return $this->dao->search_images($find, $limit, $offset);
    }
    
    public function cant_images_search($find){
        return $this->dao->cant_search_images($find);
    }
    
    public function agregar($image){
        return $this->dao->agregar($image);
    }
    
    public function existe_imagen($nombre){
        $image= $this->dao->imagen($nombre);
        if($image != NULL){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}

?>
