
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<div class="form-group">
<label class="col-md-2 control-label" for="checkboxes"><?php echo $valores["config.label"]; ?></label>
<div class="col-md-10">
<?php } ?>


       
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?>
</div>
</div>
<?php } ?>