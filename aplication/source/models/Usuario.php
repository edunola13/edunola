<?php
/**
 * Description of Usuario
 *
 * @author Usuario_2
 */
class Usuario extends ActiveRecord\Model{
    static $table_name= "usuario";
    static $primary_key= "id";
    static $has_many = array(
        array('posts', 'class_name' => 'Post', 'foreign_key' => 'autor')
    );
}

?>
