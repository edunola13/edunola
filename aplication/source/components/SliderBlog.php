<?php
/**
 * Description of SliderBlog
 *
 * @author Enola
 */
/*
 * Importar
 */
import_aplication_file("source/services/PostServices");

class SliderBlog extends En_Component{
    protected $mas_vistos;
    protected $ultimos;
    protected $ultimos_meses;
    
    protected $servicioPost;   
    
    public function __construct() {
        parent::__construct();
        $this->servicioPost= new PostServices();
    }
    
    public function rendering($params = NULL) {
        $this->mas_vistos= $this->servicioPost->mas_vistos();
        $this->ultimos= $this->servicioPost->ultimos_posts();
        $this->ultimos_meses= $this->servicioPost->ultimos_meses();
        $this->load_view("blog/slider");
    }
}

?>
