            <?php Tags::title("Administracion de Posts"); ?>
            <?php Tags::alert_message("info", $this->mensaje);?>
            <a title="Agregar" href="<?php echo BASEURL . 'admin/blog/add'; ?>" class="btn btn-primary">Agregar</a>
            <?php Tags::table(); ?>
                <thead><tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Fecha Alta</th>
                    <th>Vistas</th>
                    <th>Estado</th>
                    <th></th>
                </tr></thead>
                <?php foreach ($this->posts as $post) { ?>
                    <tr>
                        <td><?php echo $post->titulo; ?></td>
                        <td><?php echo $post->descripcion; ?></td>
                        <td><?php echo $post->fecha_alta; ?></td>
                        <td><?php echo $post->vistas; ?></td>
                        <td>
                            <?php if($post->habilitado) { ?>
                            <span title="Habilitado" class="glyphicon glyphicon-ok-circle"></span>
                            <?php } else { ?>
                            <span title="Deshabilitado" class="glyphicon glyphicon-minus-sign"></span>
                            <?php } ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-md" title="Delete" onclick="delete_post(<?php echo $post->id; ?>, <?php echo $params->current_page; ?>)">
                            <span class="glyphicon glyphicon-remove"></span></button>
                            <a title="Update" href="<?php echo BASEURL . "admin/blog/update/" . $post->id; ?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-edit"></span></a>
                        </td>
                    </tr>
                <?php } ?>                
            <?php Tags::end_table(); ?>            
            <?php Tags::paginator();?>
                <?php Tags::page_first(BASEURL . 'admin/blog/'); ?>
                <?php for ($i = 1; $i < $params->current_page; $i++) { ?>
                   <?php Tags::page($i, BASEURL . 'admin/blog/page/' . $i); ?>
                <?php } ?>
                <?php Tags::page($params->current_page, BASEURL . 'admin/blog/page/' . $params->current_page, 'active'); ?>
                <?php for ($i = $params->current_page + 1; $i <= $params->number_of_pages(); $i++) { ?>
                   <?php Tags::page($i, BASEURL . 'admin/blog/page/' . $i); ?>
                <?php } ?>
                <?php Tags::page_last(BASEURL . 'admin/blog/page/' . $params->number_of_pages()); ?>
            <?php Tags::end_paginator(); ?>