<?php if(isset($this->imagenes)) { ?>
<?php foreach ($this->imagenes as $imagen) { ?>
    <img class="imagen" alt="<?php echo $imagen->nombre;?>" src="<?php echo BASEURL . 'resources/images/' . $imagen->nombre . '.jpg'; ?> " class="" style="margin-top: 5px; width: 100%; height: 200px;">
<?php } ?>

<?php Tags::paginador_simple($params['paginador']->previous_page() != NULL ? "active" : "disabled", 
    $params['paginador']->previous_page() != NULL ? "javascript:buscar_imagen(". $params['paginador']->previous_page() .",'" . $params['find'] ."');" : "#", "Anterior", 
    $params['paginador']->next_page() != NULL ? "active" : "disabled", 
    $params['paginador']->next_page() != NULL ? "javascript:buscar_imagen(". $params['paginador']->next_page() .",'" . $params['find'] ."');" : "#", "Siguiente"); ?>
<?php } else {?>
    <h4>No hay resultados</h4>
<?php } ?>

<script>
  $(function() {
    $("#dialog").dialog({
      autoOpen: false,
      show: {
        duration: 100
      },
      hide: {
        duration: 100
      }
    });
 
    $(".imagen").click(function() {
      var alt= $(this).attr('alt');
      var url= $(this).attr('src');
      var dialogo = $("#dialog");
      dialogo.children().eq(0).html("Nombre: " + alt);
      dialogo.children().eq(1).html("URL: " + url);
      dialogo.dialog( "open" );
    });
  });
  </script>
  
  <div id="dialog" title="Información Imagen">
        <p></p>
        <p></p>
  </div>
