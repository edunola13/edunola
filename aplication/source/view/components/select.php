
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<div class="form-group">
<label class="col-md-2 control-label" for="selectbasic"><?php echo $valores["config.label"]; ?></label>
<div class="col-md-5">
<?php if(  $valores["config.multiple"] == "no"){ ?>
<select id="selectbasic" name="<?php echo $valores["config.name"]; ?>" class="form-control">
<?php } else { ?>
<select id="selectbasic" name="<?php echo $valores["config.name"]; ?>" class="form-control" multiple="multiple">
<?php } ?>           
<?php } ?>

   
 
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?> 
</select></div></div>
<?php } ?>
