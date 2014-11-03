<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>    
    <div class="container">    
        <?php $menu= "blog"; ?>
        <?php require_once 'sections/header.php'; ?>

        <section class="row list">
            <?php require_once 'sections_post/tabla_posts.php'; ?>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    <div id="dialog-confirm" title="Alerta">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea Eliminar el Post?</p>
    </div>
</body>
</html>