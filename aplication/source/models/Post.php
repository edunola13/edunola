<?php
/**
 * Description of Post
 *
 * @author Enola
 */
class Post extends ActiveRecord\Model{
    static $table_name= "post";
    static $primary_key= "id";
    static $belongs_to= array(
        array('usuario', 'class_name' => 'Usuario', 'foreign_key' => 'autor')
    );
}

?>
