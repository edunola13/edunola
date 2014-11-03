<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATHAPP.  'source/view/sections/head.php'; ?>
</head>
<body>
    <?php $menu= "games"; ?>
    <?php require_once PATHAPP.  'source/view/sections/nav.php'; ?>
    
    <div class="container">        
        <header class="row">
            <?php Tags::simple_header("Games", "");?>
            <div class="pull-right">
                <?php $menu_game= "home"; ?>
                <?php require_once 'nav.php'; ?>
            </div>
        </header>    
        <section class="row">
            Sección en Construccion......
        </section>            
    </div>
        
    <?php require_once PATHAPP.  'source/view/sections/footer.php'; ?>

</body>
</html>