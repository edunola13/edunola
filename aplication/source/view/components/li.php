
<?php if(  $valores["config.type"] == "lista_a"){ ?>
<a href="<?php echo $valores["config.href"]; ?>" class="list-group-item <?php echo $valores["config.active"]; ?>"><span class="badge"><?php echo $valores["config.badge"]; ?></span><?php echo $valores["config.label"]; ?></a>
<?php } else { ?>
<li class="list-group-item <?php echo $valores["config.active"]; ?>"><span class="badge"><?php echo $valores["config.badge"]; ?></span><?php echo $valores["config.label"]; ?></li>
<?php } ?>
