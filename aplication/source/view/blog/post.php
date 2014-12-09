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
                <div class="blog-post">
                    <?php if($this->post != NULL) { ?>
                        <h2 class="blog-post-title"><?php echo $this->post->titulo; ?></h2>
                        <p class="blog-post-meta"><?php echo $this->post->fecha_alta; ?> por <a href="#"><?php echo $this->post->usuario->nombre ; ?></a></p>
                        <?php echo $this->post->contenido; ?>
                    <?php } else { ?>
                        <h2 class="blog-post-title">El Post no Existe.</h2>
                    <?php } ?>
                    <?php if(isset($this->posts_relacionados)) { ?>
                    <?php Tags::panel('Posts Relacionados'); ?>
                        <?php foreach ($this->posts_relacionados as $relacion) { ?>
                            <?php Tags::li_a($relacion->titulo,  BASEURL . "blog/post/" . replace_spaces($relacion->titulo)); ?>
                        <?php } ?>
                    <?php Tags::end_panel(); ?>
                    <?php } ?>
                        
                    <?php if(isset($this->tags_relacionados)) { ?>
                    <?php Tags::panel('Tags'); ?>
                        <?php foreach ($this->tags_relacionados as $tag) { ?>
                            <?php Tags::li_a($tag->nombre,  BASEURL . "blog/tag/" . replace_spaces($tag->nombre)); ?>
                        <?php } ?>
                    <?php Tags::end_panel(); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col col-md-4">
                <?php execute_component("slider-blog"); ?>
            </div>
        </section>            
    </div>
        
    <?php require_once PATHAPP.  'source/view/sections/footer.php'; ?>
    <script type="text/javascript">
        $( window ).load(function() {
            $( ".blog-post" ).find("img").addClass("img-responsive");
        });
    </script>
</body>
</html>