            <?php Tags::title("Administracion de Usuarios"); ?>
            <?php Tags::alert_message("info", $this->mensaje);?>
            <?php Tags::table(); ?>
                <thead><tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Tipo Usuario</th>
                    <th>Estado</th>
                    <th></th>
                </tr></thead>
                <?php foreach ($this->usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario->usuario; ?></td>
                        <td><?php echo $usuario->nombre; ?></td>
                        <td><?php echo $usuario->email; ?></td>
                        <td><?php echo $usuario->fecha_nacimiento; ?></td>
                        <td><?php echo $usuario->tipo_usuario; ?></td>
                        <td>
                            <?php if($usuario->habilitado) { ?>
                            <span title="Habilitado" class="glyphicon glyphicon-ok-circle"></span>
                            <?php } else { ?>
                            <span title="Deshabilitado" class="glyphicon glyphicon-minus-sign"></span>
                            <?php } ?>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-primary btn-md" title="Delete" onclick="delete_user(<?php echo $usuario->id; ?>)">
                            <span class="glyphicon glyphicon-remove"></span></button>
                            <button type="button" class="btn btn-primary btn-md" title="Update" onclick="update_form(<?php echo $usuario->id; ?>)">
                            <span class="glyphicon glyphicon-edit"></span></button>
                        </td>
                    </tr>
                <?php } ?>                
            <?php Tags::end_table(); ?>