
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<form class="form-horizontal" role="form" id="formService" method="<?php echo $valores["config.method"]; ?>" action="<?php echo $valores["config.action"]; ?>" enctype="<?php echo $valores["config.enctype"]; ?>"><fieldset class="hijos-fieldset">
<?php if(  $valores["config.label"] != NULL){ ?><legend><?php echo $valores["config.label"]; ?></legend><?php } ?>
<?php } ?>
             
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?></fieldset></form><?php } ?>
