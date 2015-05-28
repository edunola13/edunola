<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "enolaphp"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <header class="row">
            <?php Tags::simple_header("Enola PHP", "- Framework para desarrollo de Aplicaciones Web");?>      
        </header>
        <div class="row">
            <article class="col col-md-4">
                <?php Tags::title("Caracteristicas del Framework"); ?>   
                <?php Tags::ul(); ?>
                    <?php Tags::li("Configuracion - JSON"); ?>
                    <?php Tags::li("Framework MVC"); ?>
                    <?php Tags::li("Patron Active Record"); ?>
                    <?php Tags::li("Filtros"); ?>
                    <?php Tags::li("Componentes"); ?>
                    <?php Tags::li("Cron Jobs"); ?>
                    <?php Tags::li("Internacionalización"); ?>
                    <?php Tags::li("Simple Integración"); ?>
                    <?php Tags::li("Servicios de interfaz de Usuario"); ?>
                <?php Tags::end_ul(); ?>
            </article>            
            <article class="col col-md-8">
                <?php Tags::title("Framework Enola PHP"); ?>
                <?php Tags::panel(); ?>
                    Enola PHP es un Framework PHP para el desarrollo de aplicaciones web 
                    que se caracteriza por su rápida configuración y fácil utilización. Presta todas las herramientas 
                    necesarias para que usted pueda realizar desde una aplicación simple a una muy compleja de una manera 
                    rápida, sencilla y reutilizando códido. </br>
                    </br>
                    <a href="http://enolaphp.com/" class="btn btn-default" target="_blank">Pagina Enola PHP</a>
                <?php Tags::end_panel(); ?>
                <?php Tags::panel("Un poco de J2EE en PHP"); ?>  
                    La idea principal de este framework es tener una estructura parecida a la de J2EE en PHP para 
                    programar en ambos lenguajes con una misma mentalidad. Cuando uno realiza una aplicación web en 
                    Java utiliza filtros, servlets, archivos de configuración (o anotaciones). También suele utilizar 
                    frameworks como struts para MVC. Nosotros intentamos eso, para eso proveemos filtros, controladores
                    (que responde a métodos HTTP como los servlets), simples archivos de configuración. Ademas la idea es
                    que sea de simple integracin con librerias y otros frameworks.
                <?php Tags::end_panel(); ?>
            </article>     
        </div>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>