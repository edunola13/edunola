                <?php Tags::form('form-upd-tag',"POST", ''); ?>
                    <?php Tags::alert_message($this->tipo_mensaje, $this->mensaje);?> 
                
                    <input type="hidden" name="id" value="<?php echo $this->tag->id; ?>" />
                       
                    <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                    <?php Tags::input("Nombre", "nombre","nombre", "text", "Nombre", $this->tag->nombre); ?>
                    <?php if(isset($this->errores['descripcion'])){ 
                    Tags::alert_message("warning", $this->errores["descripcion"]); }?>
                    <?php Tags::textarea('Descripcion', 'descripcion','descripcion', 5, 'Descripcion', $this->tag->descripcion); ?>
                    
                    <?php Tags::botonera(); ?>
                        <?php Tags::button('Modificar', '', 'submit');?>
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>

<script>
    $( '#form-update-tag form' ).submit( function( e ) {
        $.ajax( {
            url: 'tags/update',
            type: 'POST',
            data: new FormData( this ),
            processData: false,
            contentType: false,
            success: function (rta) {
                $("#form-update-tag").html(rta);
                actualizar_tags();
            },
            error: function (){
                alert("Error");
            }
        } );
        e.preventDefault();
    } );
</script>