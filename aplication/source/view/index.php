<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "home"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <?php require_once 'sections/header.php'; ?>
    
        <section class="row">
            <article class="col col-md-6">
                <?php Tags::thumbnail("Información", "Soy un estudiante avanzado de la carrera Licenciatura en Sistemas 
                    de la UNLP (Universidad Nacional de La Plata) contando ya con el titulo intermedio Analista Programador
                    Universitario. Me dedico al analisis e implementacion de distintos desarrollos de Software de una manera
                    independiente o en relación de dependencia.", BASEURL . "informacion", "Ver Más")?>
            </article>
            <article class="col col-md-6">
                <?php Tags::thumbnail("Enola PHP", "Enola es un Framework PHP para el desarrollo de aplicaciones web 
                    que se caracteriza por su rápida configuración y fácil utilización. Presta todas las herramientas 
                    necesarias para que usted pueda realizar desde una aplicación simple a una muy compleja de una manera 
                    rápida, sencilla y reutilizando códido.", BASEURL . "enola-php", "Ver Más")?>
            </article>               
        </section> 
        <section class="row">
            <article class="col col-md-6">
                <?php Tags::thumbnail("UI Services", "Los Servicios de interfaz de usuario son un conunto de tecnologias
                    y soluciones que permiten tener componentes de interfaz de usuario centralizados en un unico lugar, lo
                    cual permitira el desarrollo de la interfaz de una manera rápida y fácil y que al mismo tiempo pueda 
                    reutilizarse en distintas aplicaciones para ganar grandes tiempos en desarrollo.", BASEURL . "ui-services", "Ver Más")?>
            </article>
            <article class="col col-md-6">
                <?php Tags::thumbnail("Games", "Desarrollos de distintos tipos de juegos y simulaciones realizados con el
                    motor grafico Unity 3D y el lenguaje de programacion C#. Los desarrollos de juegos que se pueden hacer 
                    son desde simples juegos en 2D a juegos con una complejidad media en 3D.", BASEURL . "games", "Ver Más")?>
            </article>          
        </section>               
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>