<?php
/**
 * Description of PostRelacion
 *
 * @author Usuario_2
 */
class PostRelacion extends ActiveRecord\Model{
    static $table_name= "post_relacion";
    static $primary_key= "id";
    static $belongs_to= array(
        array('post_relacionado', 'class_name' => 'Post', 'foreign_key' => 'post_relacion_id',
            'select' => 'id, titulo, habilitado')
    );
}

?>
