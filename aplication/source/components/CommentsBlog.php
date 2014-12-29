<?php
/**
 * Description of ComentariosPost
 *
 * @author Enola
 */
import_aplication_file("source/services/ComentarioServices");
class CommentsBlog extends En_Component{
    protected $comentarios;
    
    private $servicio;
    
    public function __construct() {
        parent::__construct();
        $this->servicio= new ComentarioServices();
    }
    
    public function rendering($params = NULL) {
        $this->comentarios= $this->servicio->comentarios($params[0]);
        $this->load_view('blog/comentarios');
    }
}

?>