<li class="<?php echo $valores["config.state"]; ?>"><a href="<?php echo $valores["config.href"]; ?>">
<?php if(  $valores["config.first"] == "si"){ ?>    
&laquo;
<?php } else { if(  $valores["config.last"] == "si"){ ?>
&raquo
<?php } else { ?>
<?php echo $valores["config.label"]; ?>
<?php }  } ?>
</a></li>