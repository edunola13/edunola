            <article class="col col-md-10 col-md-offset-1">
                <?php Tags::form('form-upd-user',"POST", BASEURL . "admin/usuarios/update", '', "Modificacion de Usuario"); ?>
                    <?php Tags::alert_message("danger", $this->mensaje_error);?> 
                
                    <input name="id" type="hidden" value="<?php echo $this->usuario->id ?>"/>
                    <?php if(isset($this->errores['usuario'])){ 
                    Tags::alert_message("warning", $this->errores["usuario"]); }?>
                    <?php Tags::input("Usuario", "usuario","usuario", "text", "Usuario", $this->usuario->usuario); ?>
                    <?php if(isset($this->errores['clave'])){ 
                    Tags::alert_message("warning", $this->errores["clave"]); }?>
                    <?php Tags::input("Clave", "clave","clave", "password", "Clave"); ?>
                    <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                    <?php Tags::input("Nombre", "nombre","nombre", "text", "Nombre Completo", $this->usuario->nombre); ?>
                    <?php if(isset($this->errores['email'])){ 
                    Tags::alert_message("warning", $this->errores["email"]); }?>
                    <?php Tags::input("Email", "email","email", "email", "Email", $this->usuario->email); ?>
                    <?php if(isset($this->errores['fecha_nacimiento'])){ 
                    Tags::alert_message("warning", $this->errores["fecha_nacimiento"]); }?>
                    <?php Tags::input("Fecha Nacimiento", "fecha_nacimiento","fecha_nacimiento", "date", "Fecha de Nacimiento", $this->usuario->fecha_nacimiento); ?>
                    <?php Tags::boolean_checkbox("Habilitado", "habilitado","habilitado", $this->usuario->habilitado); ?>
                    <?php if(isset($this->errores['tipo'])){
                    Tags::alert_message("warning", $this->errores["tipo"]); }?>
                    <?php Tags::select("Tipo Usuario", "tipo_usuario","tipo_usuario", $this->usuario->tipo_usuario); ?>
                        <?php Tags::select_option("Administrador", "administrador"); ?>
                        <?php Tags::select_option("Blogger", "blogger"); ?>
                    <?php Tags::end_select(); ?>

                    <?php Tags::botonera(); ?>
                        <?php Tags::button('Modificar', '', 'submit');?>
                        <?php Tags::button("Cancelar", '', "button", 'add()', 'primary');?>              
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>
            </article>