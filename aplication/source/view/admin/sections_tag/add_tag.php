                <?php Tags::form("POST", ''); ?>
                    <?php Tags::alert_message($this->tipo_mensaje, $this->mensaje);?> 
                
                    <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                    <?php Tags::input("Nombre", "nombre", "text", "Nombre", $this->tag->nombre); ?>
                    <?php if(isset($this->errores['descripcion'])){ 
                    Tags::alert_message("warning", $this->errores["descripcion"]); }?>
                    <?php Tags::textarea('Descripcion', 'descripcion', 5, 'Descripcion', $this->tag->descripcion); ?>
                    
                    <?php Tags::botonera(); ?>
                        <?php Tags::button("submit", "Agregar"); ?>
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>

<script>
    $( '#form-add-tag form' ).submit( function( e ) {
        $.ajax( {
            url: 'tags/add',
            type: 'POST',
            data: new FormData( this ),
            processData: false,
            contentType: false,
            success: function (rta) {
                $("#form-add-tag").html(rta);
                actualizar_tags();
            },
            error: function (){
                alert("Error");
            }
        } );
        e.preventDefault();
    } );
</script>