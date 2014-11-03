<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>    
    <div class="container">    
        <?php $menu= "usuarios"; ?>
        <?php require_once 'sections/header.php'; ?>

        <section class="row list">
            <?php require_once 'sections_user/tabla_usuarios.php'; ?>
        </section>
        
        <section class="row add">
            <?php require_once 'sections_user/form_add_usuarios.php'; ?>
        </section>
        
        <section class="row update"> 
            <?php if(isset($params)){?>
            <?php require_once 'sections_user/form_update_usuarios.php'; ?>
            <?php } ?>
        </section>

    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    <?php if(isset($params)){?>
        <script>$(document).ready(function() {
            $(".add").hide();
            $(".update").show();});
        </script>
    <?php } ?>
    <div id="dialog-confirm" title="Alerta">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea Eliminar el Usuario? Se eliminaran todos sus Posts.</p>
    </div>
</body>
</html>