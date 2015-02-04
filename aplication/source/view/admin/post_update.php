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
                <?php Tags::form("POST", BASEURL . "admin/blog/update/" . $this->post->id , '', "Modificacion de Post"); ?>
                    <?php Tags::alert_message("info", $this->mensaje);?> 
                    <?php Tags::alert_message("danger", $this->mensaje_error);?> 
                
                    <input name="id" type="hidden" value="<?php echo $this->post->id ?>"/>
                    <?php if(isset($this->errores['titulo'])){ 
                    Tags::alert_message("warning", $this->errores["titulo"]); }?>
                    <?php Tags::input("Titulo", "titulo", "text", "Titulo", $this->post->titulo); ?>
                    <?php if(isset($this->errores['descripcion'])){ 
                    Tags::alert_message("warning", $this->errores["descripcion"]); }?>
                    <?php Tags::textarea("Descripcion", "descripcion", 5, "Descripcion del Post", $this->post->descripcion); ?>
                    <?php if(isset($this->errores['contenido'])){ 
                    Tags::alert_message("warning", $this->errores["contenido"]); }?>
                    <textarea name="contenido" id="contenido" placeholder="Descripcion del Post" rows="10" cols="50" ><?php echo $this->post->contenido; ?></textarea>
                    <script>
                        CKEDITOR.replace( 'contenido' );
                    </script>
                    <?php Tags::boolean_checkbox("Habilitado", "habilitado", $this->post->habilitado); ?>
                    <?php Tags::select("Posts Relacionados", "relacion[]", $this->relaciones, TRUE); ?>
                        <?php foreach ($this->posts as $pos) { ?>
                            <?php Tags::select_option($pos->titulo, $pos->id); ?>
                        <?php } ?>
                    <?php Tags::end_select(); ?>
                    <?php Tags::select("Tags", "tags[]", $this->tags_rel, TRUE); ?>
                        <?php foreach ($this->tags as $tag) { ?>
                            <?php Tags::select_option($tag->nombre, $tag->id); ?>
                        <?php } ?>
                    <?php Tags::end_select(); ?>
                    
                    <?php Tags::botonera(); ?>
                        <?php Tags::button("submit", "Modificar"); ?>
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