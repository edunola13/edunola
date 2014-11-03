<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "contacto"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <?php require_once 'sections/header.php'; ?>
        
        <?php Tags::title("Contacto"); ?>
        <?php Tags::paragraph();?>
            <?php Tags::text("Culquier consulta que usted tenga nos la puede enviar por aca."); ?>
        <?php Tags::end_paragraph(); ?>
        
        <section class="row">
            <?php Tags::formulario("POST", BASEURL . "contacto"); ?>
                <?php Tags::alert_message("danger", $this->mensaje);?>            
                
                <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                <?php Tags::input("Nombre", "nombre", "text", "Nombre", $this->email['nombre']);?> 
                                
                <?php if(isset($this->errores['email'])){
                    Tags::alert_message("warning", $this->errores["email"]); }?>
                <?php Tags::input("Email", "email", "email", "Email", $this->email['email']);?> 
            
                <?php if(isset($this->errores['asunto'])){
                    Tags::alert_message("warning", $this->errores["asunto"]); }?>
                <?php Tags::select("Asunto", "asunto", $this->email['asunto']); ?>
                    <?php Tags::select_option("General", "General"); ?>
                    <?php Tags::select_option("Enola PHP", "Enola PHP"); ?>
                    <?php Tags::select_option("UI Services", "UI Services"); ?>
                    <?php Tags::select_option("Games", "Games"); ?>
                <?php Tags::end_select(); ?>
                  
                <?php if(isset($this->errores['mensaje'])){
                    Tags::alert_message("warning", $this->errores["mensaje"]); }?>
                <?php Tags::textarea("Mensaje", "mensaje", 10, "Mensaje a Enviar", $this->email['mensaje']);?>
            
                <?php Tags::botonera(); ?>            
                <?php Tags::button("submit", "Enviar"); ?>
                <?php Tags::button("reset", "Borrar"); ?>
                <?php Tags::end_botonera(); ?>
            <?php Tags::end_formulario(); ?>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>