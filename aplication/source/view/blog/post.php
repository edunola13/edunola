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
                        <div>
                            <h2 class="titulo-principal"><?php echo $this->post->titulo; ?></h2>
                            <p class="blog-post-meta"><?php echo $this->post->fecha_alta; ?> por <a href="#"><?php echo $this->post->usuario->nombre ; ?></a></p>
                        </div>
                        <?php echo $this->post->contenido; ?>
                    <?php } else { ?>
                        <h2 class="blog-post-title">El Post no Existe.</h2>
                    <?php } ?>                    
                        
                    <?php if($this->posts_relacionados != NULL) { ?>
                    <?php Tags::panel('Posts Relacionados'); ?>
                        <?php foreach ($this->posts_relacionados as $relacion) { ?>
                            <?php Tags::li_a($relacion->titulo,  BASEURL . "blog/post/" . replace_spaces($relacion->titulo)); ?>
                        <?php } ?>
                    <?php Tags::end_panel(); ?>
                    <?php } ?>
                        
                    <?php if($this->tags_relacionados != NULL) { ?>
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
        <section>
            <?php Tags::well('Por favor, deje su comentario sobre el Post.'); ?>
            <div id="list-comentarios">
                
            </div>
            <div id="form-comentario" class="col col-md-10 col-md-offset-1">
            <?php Tags::form('form-coment','POST', '', '', 'Agregue un Comentario') ?>
                <input id="post_id" name="post_id" type="hidden" value="<?php echo $this->post->id;?>">
                
                <?php Tags::input("Nombre", 'nombre',"nombre", "text", "Nombre", '');?> 
                
                <?php Tags::textarea("Mensaje", 'comentario',"comentario", 5, "Mensaje a Enviar", '');?>
            
                <?php Tags::botonera(); ?>            
                <?php Tags::button('Enviar', '', 'submit');?>
                <?php Tags::end_botonera(); ?>
            <?php Tags::end_form();?>
            </div>
        </section>
    </div>

    <?php require_once PATHAPP.  'source/view/sections/footer.php'; ?>    
    <script type="text/javascript">
        $( window ).load(function() {
            $( ".blog-post" ).find("img").addClass("img-responsive");
        });
        $(document).ready(function() {
            comentarios(<?php echo $this->post->id;?>);
        });
    </script>
</body>
</html>