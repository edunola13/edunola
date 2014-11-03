<?php if(isset($this->errores['nombre'])){ 
    Tags::alert_message("warning", $this->errores["nombre"]); }?>
<?php if(isset($this->errores['imagen'])){ 
    Tags::alert_message("warning", $this->errores["imagen"]); }?>
<?php Tags::alert_message("info", $this->mensaje);?> 
<?php Tags::alert_message("danger", $this->mensaje_error);?>