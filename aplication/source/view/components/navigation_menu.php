

<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "cabecera"){ ?>
<?php if(  $valores["config.type"] == "tabs"){ ?>
<?php if(  $valores["config.justified"] == "si"){ ?>
<ul class="nav nav-tabs nav-justified">
<?php } else { ?>
<ul class="nav nav-tabs">
<?php } ?>
<?php } else { ?>
<?php if(  $valores["config.stacked"] == "si"){ ?>
<ul class="nav nav-pills nav-stacked">
<?php } else { if(  $valores["config.justified"] == "si"){ ?>
<ul class="nav nav-pills nav-justified">      
<?php } else { ?>
<ul class="nav nav-pills">        
<?php }  } ?>
<?php } ?>
<?php } ?>


                      
<?php if(  $valores["config.seccion"] == NULL || $valores["config.seccion"] == "pie"){ ?></ul><?php } ?>
