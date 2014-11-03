
<?php if(  $valores["config.type"] == "lista_a"){ ?>
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<div class="list-group">
<?php } ?>

<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?>
</div>
<?php } ?>
<?php } else { ?>
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<ul class="list-group">
<?php } ?>

<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?>
</ul>
<?php } ?>
<?php } ?>
