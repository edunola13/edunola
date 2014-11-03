<?php
/**
 * Description of ImageServices
 *
 * @author Enola
 */
class ImageServices {
    
    public function search_images($find, $limit = 0, $offset = 0){
        $cond= array('conditions' => array("nombre LIKE '%" . $find . "%'"), 'limit' => $limit, 'offset' => $offset, 'order' => 'nombre desc');        
        return Image::all($cond);
    }
    
    public function cant_images_search($find){
        $cond= array('select' => 'count(*) as cant', 'conditions' => array("nombre LIKE '%" . $find . "%'"));
        $cantidad= Image::find($cond);
        return $cantidad->cant;
    }
    
    public function agregar($image){
        $image->save();
        return $image;
    }
    
    public function existe_imagen($nombre){
        $options= array('conditions' => array('nombre = ?', $nombre));
        $images= Image::all($options);
        if(count($images) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}

?>
