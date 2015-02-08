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
            <?php Tags::form('form_contacto',"POST", BASEURL . "contacto"); ?>
                <?php Tags::alert_message("danger", $this->mensaje);?>            
                
                <?php Tags::input("Nombre", 'nombre',"nombre", "text", "Nombre", $this->email['nombre'], (isset($this->errores['nombre']) ? $this->errores['nombre'] : NULL), 'error');?> 
                
                <?php Tags::input("Email", 'email',"email", "email", "Email", $this->email['email'], (isset($this->errores['email']) ? $this->errores['email'] : NULL), 'error');?> 
            
                <?php if(isset($this->errores['asunto'])){
                    Tags::alert_message("warning", $this->errores["asunto"]); }?>
            
                <?php Tags::select("Asunto", "asunto","asunto", $this->email['asunto'], NULL,FALSE,(isset($this->errores['asunto']) ? $this->errores['asunto'] : NULL),'error'); ?>
                    <?php Tags::select_option("General", "General"); ?>
                    <?php Tags::select_option("Enola PHP", "Enola PHP"); ?>
                    <?php Tags::select_option("UI Services", "UI Services"); ?>
                    <?php Tags::select_option("Games", "Games"); ?>
                <?php Tags::end_select(); ?>
                  
                <?php Tags::textarea("Mensaje", "mensaje","mensaje", 10, "Mensaje a Enviar", $this->email['mensaje'],(isset($this->errores['mensaje']) ? $this->errores['mensaje'] : NULL),'error');?>
            
                <?php Tags::botonera(); ?>            
                <?php Tags::button('Enviar', '', 'submit');?>
                <?php Tags::button("Borrar", '', 'reset'); ?>
                <?php Tags::end_botonera(); ?>
            <?php Tags::end_form(); ?>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>