
<?php if(  $valores["config.inline"] == "no"){ ?>
<div class="checkbox">
<label for="checkboxes-<?php echo $valores["config.num"]; ?>">
<?php if(  $valores["config.checked"] == "si"){ ?>
<input type="checkbox" name="<?php echo $valores["config.name"]; ?>" id="checkboxes-<?php echo $valores["config.num"]; ?>" value="<?php echo $valores["datos.value"]; ?>" checked="checked">
<?php } else { ?>
<input type="checkbox" name="<?php echo $valores["config.name"]; ?>" id="checkboxes-<?php echo $valores["config.num"]; ?>" value="<?php echo $valores["datos.value"]; ?>">
<?php } ?>
<?php echo $valores["config.label"]; ?>
</label>
</div>
<?php } else { ?>
<label class="checkbox-inline" for="checkboxes-<?php echo $valores["config.num"]; ?>">
<?php if(  $valores["config.checked"] == "si"){ ?>
<input type="checkbox" name="<?php echo $valores["config.name"]; ?>" id="checkboxes-<?php echo $valores["config.num"]; ?>" value="<?php echo $valores["datos.value"]; ?>" checked="checked">
<?php } else { ?>
<input type="checkbox" name="<?php echo $valores["config.name"]; ?>" id="checkboxes-<?php echo $valores["config.num"]; ?>" value="<?php echo $valores["datos.value"]; ?>">
<?php } ?>
<?php echo $valores["config.label"]; ?>
</label>
<?php } ?>
