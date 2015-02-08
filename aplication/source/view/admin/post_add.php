<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>    
    <script src="<?php echo BASEURL . 'resources/ckeditor/ckeditor.js'; ?>"></script>
</head>
<body>    
    <div class="container">    
        <?php $menu= "blog"; ?>
        <?php require_once 'sections/header.php'; ?>

        <section class="row list">
            <article class="col col-md-9">
                <?php Tags::form('form-add-post',"POST", BASEURL . "admin/blog/add", '', "Alta de Post"); ?>
                    <?php Tags::alert_message("info", $this->mensaje);?> 
                    <?php Tags::alert_message("danger", $this->mensaje_error);?> 
                
                    <?php if(isset($this->errores['titulo'])){ 
                    Tags::alert_message("warning", $this->errores["titulo"]); }?>
                    <?php Tags::input("Titulo", "titulo","titulo", "text", "Titulo", $this->post->titulo); ?>
                    <?php if(isset($this->errores['descripcion'])){ 
                    Tags::alert_message("warning", $this->errores["descripcion"]); }?>
                    <?php Tags::textarea("Descripcion", "descripcion","descripcion", 5, "Descripcion del Post", $this->post->descripcion); ?>
                    <?php if(isset($this->errores['contenido'])){ 
                    Tags::alert_message("warning", $this->errores["contenido"]); }?>
                    <textarea name="contenido" id="contenido" placeholder="Descripcion del Post" rows="10" cols="50" ><?php echo $this->post->contenido; ?></textarea>
                    <script>
                        CKEDITOR.replace( 'contenido' );
                    </script> 
                    <?php Tags::boolean_checkbox("Habilitado", "habilitado","habilitado", $this->post->habilitado); ?>

                    <?php Tags::select("Posts Relacionados", 'relacion',"relacion[]", $this->relaciones, NULL,TRUE); ?>
                        <?php foreach ($this->posts as $pos) { ?>
                            <?php Tags::select_option($pos->titulo, $pos->id); ?>
                        <?php } ?>
                    <?php Tags::end_select(); ?>
                    <?php Tags::select("Tags", "tags","tags[]", $this->tags_rel, NULL,TRUE); ?>
                        <?php foreach ($this->tags as $tag) { ?>
                            <?php Tags::select_option($tag->nombre, $tag->id); ?>
                        <?php } ?>
                    <?php Tags::end_select(); ?>
                                
                    <?php Tags::botonera(); ?>
                        <?php Tags::button('Agregar', '', 'submit');?>
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>
            </article>
            <div class="col col-md-3">
                <?php include 'sections_post/slider_images.php'; ?>
            </div>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>    
</body>
</html>