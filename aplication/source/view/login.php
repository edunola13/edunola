<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "login"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <?php require_once 'sections/header.php'; ?>
              
        <section class="row">            
            <div class="col col-md-8 col-md-offset-2">                
            <?php Tags::form("POST", BASEURL . "login", '', "Login"); ?>                     
                <?php Tags::alert_message("danger", $this->mensaje);?> 
                
                <?php if(isset($this->errores['usuario'])){ 
                    Tags::alert_message("warning", $this->errores["usuario"]); }?>
                <?php Tags::input("Usuario", "usuario", "text", "Usuario", $this->usuario['usuario']);?> 
                                
                <?php if(isset($this->errores['clave'])){
                    Tags::alert_message("warning", $this->errores["clave"]); }?>
                <?php Tags::input("Contraseña", "clave", "password", "Contraseña");?> 

                <?php Tags::botonera(); ?>            
                <?php Tags::button("submit", "Ingresar"); ?>
                <?php Tags::button("reset", "Borrar"); ?>
                <?php Tags::end_botonera(); ?>
            <?php Tags::end_form(); ?>
            </div>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>