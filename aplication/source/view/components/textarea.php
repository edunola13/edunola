 <?php if(  $valores["config.typeError"] == NULL || $valores["config.message"] == NULL){ ?><div class="form-group"><?php } else { ?><div class="form-group has-<?php echo $valores["config.typeError"]; ?>"><?php } ?> <label for="text_area" class="col-md-2 control-label input-<?php echo $valores["config.size"]; ?>"><?php echo $valores["config.label"]; ?></label> <div class="col-md-10">  <textarea class="form-control input-<?php echo $valores["config.size"]; ?>" id="<?php echo $valores["config.id"]; ?>" name="<?php echo $valores["config.name"]; ?>" placeholder="<?php echo $valores["config.placeholder"]; ?>" rows="<?php echo $valores["config.rows"]; ?>"><?php echo $valores["datos.value"]; ?></textarea> <?php if(  $valores["config.message"] != NULL){ ?><span class="help-block"><?php echo $valores["config.message"]; ?></span><?php } ?> </div></div>