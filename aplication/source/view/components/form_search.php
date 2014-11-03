<div class="well">
<h4><span class="glyphicon glyphicon-search"></span> <?php echo $valores["config.label"]; ?></h4>
<div class="input-group">
<input type="text" class="form-control" name="<?php echo $valores["config.input.name"]; ?>" placeholder="<?php echo $valores["config.input.placeholder"]; ?>" value="<?php echo $valores["datos.value_input"]; ?>">
<span class="input-group-btn"><button class="btn btn-default" type="button" id="<?php echo $valores["config.id"]; ?>" onclick="<?php echo $valores["config.onclick"]; ?>"><span class="glyphicon glyphicon-search"></span></button></span>
</div>
</div>