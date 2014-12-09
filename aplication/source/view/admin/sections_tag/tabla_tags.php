            <?php Tags::title("Administracion de Tags"); ?>
            <?php Tags::alert_message($this->tipo_mensaje, $this->mensaje);?>
            <a title="Agregar" class="btn btn-primary" onclick="form_add_tag()">Agregar</a>
            <?php Tags::table(); ?>
                <thead><tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th></th>
                </tr></thead>
                <?php foreach ($this->tags as $tag) { ?>
                    <tr>
                        <td><?php echo $tag->nombre; ?></td>
                        <td><?php echo $tag->descripcion; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-md" title="Delete" onclick="delete_tag('<?php echo $tag->id;?>')">
                            <span class="glyphicon glyphicon-remove"></span></button>
                            <button type="button" class="btn btn-primary btn-md" title="Update" onclick="form_update_tag('<?php echo $tag->id;?>')">
                            <span class="glyphicon glyphicon-edit"></span></button>
                        </td>
                    </tr>
                <?php } ?>                
            <?php Tags::end_table(); ?>