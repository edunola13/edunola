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
import_aplication_file("source/services/TagServices");
class SliderBlog extends En_Component{
    protected $mas_vistos;
    protected $ultimos;
    protected $ultimos_meses;
    protected $tags;
    
    protected $servicioPost;
    protected $servivioTag;
    
    public function __construct() {
        parent::__construct();
        $this->servicioPost= new PostServices();
        $this->servivioTag= new TagServices();
    }
    
    public function rendering($params = NULL) {
        $this->mas_vistos= $this->servicioPost->mas_vistos();
        $this->ultimos= $this->servicioPost->ultimos_posts();
        $this->ultimos_meses= $this->servicioPost->ultimos_meses();
        $this->tags= $this->servivioTag->tags();
        $this->load_view("blog/slider");
    }
}

?>
