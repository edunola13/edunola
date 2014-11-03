<?php Tags::panel("Imagenes"); ?>
<?php Tags::navigation_menu("pills", TRUE) ?>
    <?php Tags::nav_item("Agregar","javascript:cargar_imagen();"); ?>
<?php Tags::end_navigation_menu(); ?>
<div class="input-group">
    <input name="imagen-find" type="text" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="buscar_imagen()"><span class="glyphicon glyphicon-search"></span></button>   
    </span>
</div>
<div id="imagenes">
    
</div>
<?php Tags::end_panel(); ?>

<!-- Modal -->
<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargar Imagen</h4>
    </div>
    <div class="modal-body">
        <form id="form-image" class="form-inline" role="form" method="post" enctype="multipart/form-data">
            <div class="informacion">
                
            </div>
            <div class="form-group">
                <label class="sr-only" for="ejemplo_email_2">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Imagen">
            </div>
            <div class="form-group">
                <label class="sr-only" for="ejemplo_password_2">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
            </div>
            <button type="submit" class="btn btn-default">Guardar</button>
        </form>
    </div>
    </div>
</div>
</div>