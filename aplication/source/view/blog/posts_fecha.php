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
                <div class="second-title">
                    <h2 class="blog-post-title">Posts de Periodo <?php echo $this->params[0] . '-' . $this->params[1]; ?></h2>
                </div>
                <?php foreach ($this->posts as $post) { ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><?php echo $post->titulo; ?></h2>
                        <p class="blog-post-meta"><?php echo $post->fecha_alta; ?> por <a href="#"><?php echo $post->usuario->nombre; ?></a></p>
                        <?php echo $post->descripcion; ?>
                        </br><a href="<?php echo BASEURL . "blog/post/" . replace_spaces($post->titulo); ?>" class="pull-right btn btn-primary">Leer</a>
                    </div>
                <?php } ?>
            </div>
            <div class="col col-md-4">
                <?php execute_component("slider-blog"); ?>
            </div>
        </section>            
    </div>
        
    <?php require_once PATHAPP.  'source/view/sections/footer.php'; ?>
</body>
</html>