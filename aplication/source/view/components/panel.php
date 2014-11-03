
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<div class="panel panel-default">
<?php if(  $valores["config.titulo"] != NULL){ ?><div class="panel-heading"><h3 class="panel-title"><?php echo $valores["config.titulo"]; ?></h3></div><?php } ?>
<div class="panel-body"><?php } ?>



<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?>
</div><?php if(  $valores["config.pie"] != NULL){ ?><div class="panel-footer"><?php echo $valores["config.pie"]; ?></div><?php } ?></div><?php } ?>
