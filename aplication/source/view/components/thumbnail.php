<div class="thumbnail">
<?php if(  $valores["config.src"] != NULL){ ?>
<img src="<?php echo $valores["config.src"]; ?>" alt="<?php echo $valores["config.alt"]; ?>">
<?php } ?>
<div class="caption">
<h3><?php echo $valores["config.titulo"]; ?></h3>
<p><?php echo $valores["config.contenido"]; ?></p>
<p>
<a href="<?php echo $valores["config.href"]; ?>" class="btn btn-primary" role="button"><?php echo $valores["config.label"]; ?></a>
</p>
</div>
</div>