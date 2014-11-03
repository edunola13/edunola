    <?php Tags::navigation_bar("Nola", BASEURL);?>
        <?php Tags::nav_bar_left();?>
            <?php Tags::nav_item("Home", BASEURL, $menu == "home" ? "active" : NULL);?>
            <?php Tags::nav_item("Información", BASEURL . 'informacion', $menu == "informacion" ? "active" : NULL); ?>
            <?php Tags::nav_item("Enola PHP", BASEURL . "enola-php", $menu == "enolaphp" ? "active" : NULL);?>
            <?php Tags::nav_item("UI Services", BASEURL . "ui-services", $menu == "uiservices" ? "active" : NULL);?>
            <?php Tags::nav_item("Games", BASEURL . "games", $menu == "games" ? "active" : NULL);?>
            <?php Tags::nav_item("Blog", BASEURL . "blog", $menu == "blog" ? "active" : NULL);?>
            <?php Tags::nav_item("Contacto", BASEURL . "contacto", $menu == "contacto" ? "active" : NULL);?>
        <?php Tags::end_nav_bar_left();?>
                
        <?php Tags::nav_bar_right();?>
            <?php Tags::nav_item("Ingresar", BASEURL . "login", $menu == "login" ? "active" : NULL);?>
        <?php Tags::end_nav_bar_right(); ?>
    <?php Tags::end_navigation_bar();?>