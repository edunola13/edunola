            <?php if($this->comentarios != NULL){?>
                <?php foreach ($this->comentarios as $comentario) { ?>
                    <?php if($params['admin']){?>
                    <button type="button" class="btn btn-danger btn-xs config delete pull-right" title="Delete" onclick="eliminar_comentario('<?php echo $comentario->id?>','<?php echo $params['idPost'];?>')">X</button>
                    <?php }?>
                    <div class="media comentario">
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $comentario->nombre . ' -> ' . $comentario->nombreUsuario();?></h4>
                          <?php echo $comentario->comentario;?>
                        </div>
                    </div>
                <?php } ?>                
            <?php } else{?>
                <h4>No Hay Comentarios. Sea el primero!!!</h4>
            <?php } ?>