<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>    
    <div class="container">    
        <?php $menu= "home"; ?>
        <?php require_once 'sections/header.php'; ?>
    
        <section class="row">
            <article class="col col-md-7">
                <?php Tags::form("POST", BASEURL . "admin", '', "Información Personal"); ?>
                    <?php Tags::alert_message("info", $this->mensaje);?> 
                
                    <input name="id" type="hidden" value="<?php echo $this->usuario->id ?>"/>
                    <?php if(isset($this->errores['usuario'])){ 
                    Tags::alert_message("warning", $this->errores["usuario"]); }?>
                    <?php Tags::input("Usuario", "usuario", "text", "Usuario", $this->usuario->usuario); ?>
                    <?php if(isset($this->errores['clave'])){ 
                    Tags::alert_message("warning", $this->errores["clave"]); }?>
                    <?php Tags::input("Clave", "clave", "password", "Clave"); ?>
                    <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                    <?php Tags::input("Nombre", "nombre", "text", "Nombre Completo", $this->usuario->nombre); ?>
                    <?php if(isset($this->errores['email'])){ 
                    Tags::alert_message("warning", $this->errores["email"]); }?>
                    <?php Tags::input("Email", "email", "email", "Email", $this->usuario->email); ?>
                    <?php if(isset($this->errores['fecha_nacimiento'])){ 
                    Tags::alert_message("warning", $this->errores["fecha_nacimiento"]); }?>
                    <?php Tags::input("Fecha Nacimiento", "fecha_nacimiento", "date", "Fecha de Nacimiento", $this->usuario->fecha_nacimiento); ?>
                
                    <?php Tags::botonera(); ?>
                        <?php Tags::button("submit", "Modificar"); ?>
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>
            </article>
            <article class="col col-md-5">
                <?php Tags::thumbnail("Usuarios", "Administre a los usuarios de la Aplicación Web. Liste a los usuarios, de de alta un nuevo usuario, modifique un usuario y elimine un usuario.", BASEURL . "admin/usuarios", "Administrar")?>
                <?php Tags::thumbnail("Blog", "Postee sus propios articulos.", BASEURL . "admin/blog", "Administrar")?>
            </article>
        </section>          
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>