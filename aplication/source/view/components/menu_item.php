
<?php if(  $valores["config.type"] == "item"){ ?>
<?php if(  $valores["config.disabled"] == "si"){ ?>
<li role="presentation" class="disabled">
<?php } else { ?>
<li role="presentation">
<?php } ?>
<a role="menuitem" tabindex="-1" href="<?php echo $valores["config.href"]; ?>"><?php echo $valores["config.label"]; ?></a>
</li>
<?php } else { if(  $valores["config.type"] == "item_onclick"){ ?>
<?php if(  $valores["config.disabled"] == "si"){ ?>
<li role="presentation" class="disabled">
<?php } else { ?>
<li role="presentation">
<?php } ?>
<a role="menuitem" tabindex="-1" onclick="<?php echo $valores["config.href"]; ?>"><?php echo $valores["config.label"]; ?></a>
</li>
<?php } else { if(  $valores["config.type"] == "divider"){ ?>
<li role="presentation" class="divider"></li>
<?php } else { ?>
<li role="presentation" class="dropdown-header"><?php echo $valores["config.label"]; ?></li>
<?php }  }  } ?>
