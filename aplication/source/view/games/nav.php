<?php Tags::navigation_menu("pills"); ?>
<?php Tags::nav_item("Home", BASEURL . 'games', $menu_game == "home" ? "active" : NULL); ?>
<?php Tags::nav_item("Desarrollos", BASEURL . 'games/desarrollos', $menu_game == "desarrollos" ? "active" : NULL); ?>
<?php Tags::nav_item("Tecnologias", BASEURL . 'games/tecnologias', $menu_game == "tecnologias" ? "active" : NULL); ?>
<?php Tags::end_navigation_menu(); ?>
