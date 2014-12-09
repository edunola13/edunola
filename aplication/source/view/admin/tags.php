<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>    
    <div class="container">    
        <?php $menu= "tags"; ?>
        <?php require_once 'sections/header.php'; ?>

        <section class="row list">
            <?php require_once 'sections_tag/tabla_tags.php'; ?>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    <div id="dialog-confirm" title="Alerta">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea Eliminar el Tag?</p>
    </div>
    
    <div id="form-add-tag" title="Agregar Tag">        
    </div>
    <div id="form-update-tag" title="Modificar Tag">        
    </div>
</body>
</html>