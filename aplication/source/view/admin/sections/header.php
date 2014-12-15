<header class="row">
    <?php Tags::simple_header("Admin Page", "- ". $this->request->session->get_unserialize('usuario_session')->nombre);?>      
    
    <?php Tags::navigation_menu("pills"); ?>
    <?php Tags::nav_item("Home", BASEURL . "admin", $menu == "home" ? "active" : NULL); ?>
    <?php if($this->request->session->get('user_logged') == 'administrador') {
        Tags::nav_item("Usuarios", BASEURL . "admin/usuarios", $menu == "usuarios" ? "active" : NULL); 
    }?>
    <?php Tags::nav_item("Blog", BASEURL . "admin/blog", $menu == "blog" ? "active" : NULL); ?>
    <?php Tags::nav_item("Tags", BASEURL . "admin/tags", $menu == "tags" ? "active" : NULL); ?>
    <?php Tags::nav_item_drop_down($this->request->session->get_unserialize('usuario_session')->usuario, TRUE); ?>
        <?php Tags::menu_item("item", "Información Personal", BASEURL . "admin"); ?>
        <?php Tags::menu_item("item", "Cerrar Sesion", BASEURL . "logout"); ?>
    <?php Tags::end_nav_item_drop_down(); ?>
    <?php Tags::end_navigation_menu(); ?>
</header>