            <article class="col col-md-10 col-md-offset-1">
                <?php Tags::form("POST", BASEURL . "admin/usuarios/add", '', "Alta de Usuario"); ?>
                    <?php Tags::alert_message("danger", $this->mensaje_error);?> 
                
                    <?php if(isset($this->errores['usuario'])){ 
                    Tags::alert_message("warning", $this->errores["usuario"]); }?>
                    <?php Tags::input("Usuario", "usuario", "text", "Usuario", $this->usuario->usuario); ?>
                    <?php if(isset($this->errores['clave'])){ 
                    Tags::alert_message("warning", $this->errores["clave"]); }?>
                    <?php Tags::input("Clave", "clave", "password", "Clave"); ?>
                    <?php if(isset($this->errores['nombre'])){ 
                    Tags::alert_message("warning", $this->errores["nombre"]); }?>
                    <?php Tags::input("Nombre", "nombre", "text", "Nombre Completo", $this->usuario->nombre); ?>
                    <?php if(isset($this->errores['email'])){ 
                    Tags::alert_message("warning", $this->errores["email"]); }?>
                    <?php Tags::input("Email", "email", "email", "Email", $this->usuario->email); ?>
                    <?php if(isset($this->errores['fecha_nacimiento'])){ 
                    Tags::alert_message("warning", $this->errores["fecha_nacimiento"]); }?>
                    <?php Tags::input("Fecha Nacimiento", "fecha_nacimiento", "date", "Fecha de Nacimiento", $this->usuario->fecha_nacimiento); ?>
                    <?php Tags::boolean_checkbox("Habilitado", "habilitado", $this->usuario->habilitado); ?>
                    <?php if(isset($this->errores['tipo'])){
                    Tags::alert_message("warning", $this->errores["tipo"]); }?>
                    <?php Tags::select("Tipo Usuario", "tipo_usuario", $this->usuario->tipo_usuario); ?>
                        <?php Tags::select_option("Administrador", "administrador"); ?>
                        <?php Tags::select_option("Blogger", "blogger"); ?>
                    <?php Tags::end_select(); ?>
                    
                    <?php Tags::botonera(); ?>
                        <?php Tags::button("submit", "Agregar"); ?>
                    <?php Tags::end_botonera(); ?>
                <?php Tags::end_form(); ?>
            </article>