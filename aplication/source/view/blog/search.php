<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATHAPP.  'source/view/sections/head.php'; ?>
    <link href="<?php echo BASEURL . 'resources/css/blog.css'; ?>" rel="stylesheet">
</head>
<body>
    <?php $menu= "blog"; ?>
    <?php require_once PATHAPP.  'source/view/sections/nav.php'; ?>
    
    <div class="container blog-body">        
        <?php require_once 'sections/title.php'; ?>
        <section class="row">
            <div class="col col-md-8">
                <?php if(count($this->posts) == 0){ ?>
                    <h4>No se encontraron resultados para su Busqueda.</h4>
                <?php } ?>
                <?php foreach ($this->posts as $post) { ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><?php echo $post->titulo; ?></h2>
                        <p class="blog-post-meta"><?php echo $post->fecha_alta; ?> por <a href="#"><?php echo $post->usuario->nombre; ?></a></p>
                        <?php echo $post->descripcion; ?>
                        </br><a href="<?php echo BASEURL . "blog/post/" . replace_spaces($post->titulo); ?>" class="pull-right btn btn-primary">Leer</a>
                    </div>
                <?php } ?>
                <?php Tags::paginador_simple($params['paginador']->previous_page() != NULL ? "active" : "disabled", 
                        $params['paginador']->previous_page() != NULL ? BASEURL . 'blog/search/' . $params['find'] . '/' . $params['paginador']->previous_page() : "#", "Anterior", 
                        $params['paginador']->next_page() != NULL ? "active" : "disabled", 
                        $params['paginador']->next_page() != NULL ? BASEURL . 'blog/search/' . $params['find'] . '/' . $params['paginador']->next_page() : "#", "Siguiente"); ?>
            </div>
            <div class="col col-md-4">
                <?php execute_component("slider-blog"); ?>
            </div>
        </section>            
    </div>
        
    <?php require_once PATHAPP.  'source/view/sections/footer.php'; ?>
</body>
</html>