<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "uiservices"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <header class="row">
            <?php Tags::simple_header("UI Services", "- La manera de Integrar las Interfaces de Usuario");?>      
        </header>
        <section class="row">
            <?php Tags::panel('UI Services'); ?>
                <?php Tags::paragraph();?>
                Los Servicios de interfaz de usuario son un conunto de tecnologias
                y soluciones que permiten tener componentes de interfaz de usuario centralizados en un unico lugar, lo
                cual permitira el desarrollo de la interfaz de una manera rápida y fácil y que al mismo tiempo pueda 
                reutilizarse en distintas aplicaciones para ganar grandes tiempos en desarrollo.
                <?php Tags::end_paragraph();?>
                <?php Tags::paragraph();?>
                Por un lado se encuentra el Servidor UI desarrollado en PHP utilizandoce Enola PHP el cual contendrá 
                definiciones de componentes (UI) web que estan desarrollados utilizando el Framework Bootstrap para 
                lograr su estandarización.
                El servidor presentará una interfaz de acceso para las aplicaciones de manera que estas se puedan 
                comunicar con él para desarrollar su interfaz.
                <?php Tags::end_paragraph();?>                
                <?php Tags::paragraph();?>
                El usuario tendra 2 opciones para consumir los Servicios UI:
                <?php Tags::end_paragraph();?>
                <div class="pull-right"><?php Tags::link('', 'http://www.edunola.com.ar/blog/post/UI-Services-___-Definición-de-Componentes', 'Componentes', TRUE, 'info')?></div>
                <div class="pull-right"><?php Tags::link('', 'http://www.edunola.com.ar/blog/post/UI-Services-___-Servicios-de-Interfaz-de-Usuario-___-v.1.0', 'Información', TRUE, 'default')?></div>
            <?php Tags::end_panel(); ?>
            <div class="row">
                <article class="col col-md-6">                
                    <?php Tags::thumbnail("Builder", "El Builder HTML es una aplicacion que permitirá a un usuario armar su 
                        propia UI mediante los componentes definidos en el Servidor UI y otras opciones que provee el Builder.
                        Mediante Drag ad Drop el usuario podrá ir agregando componentes, eliminarlos, moverlos de lugar y cambiar
                        su configuración.", BASEURL . "builder", "Ir al Builder")?>
                </article>
                <article class="col col-md-6">                
                    <?php Tags::thumbnail("APIs", "Las APIs permiten a su aplicacion utilizar los componentes definidos en el
                        Servidor UI. La API es la encargada de facilitar el uso de los componentes definidos en el Servidor UI. 
                        Para lograr esto, por un lado las APIs presentan una interfaz de acceso sencilla a los componentes y por
                        otro lado se comunica con el servidor para solicitar los componentes. Las APIs se encuentran disponibles
                        en Java y PHP.", 'http://www.edunola.com.ar/blog/post/UI-Services-___-APIs-PHP-y-Java', "Ver Más")?>
                </article>
            </div>
            <div class="row">
                <h3 class="col col-md-12">Descargas</h3>
                <div class="col col-sm-4" style="display:flex;justify-content:center;align-items:center; margin-bottom: 5px;">
                    <?php Tags::link('', 'https://github.com/edunola13/uiservices', 'Descargar Servidor', TRUE, 'info') ?>
                </div>
                <div class="col col-sm-4" style="display:flex;justify-content:center;align-items:center; margin-bottom: 5px;">
                    <?php Tags::link('', 'https://github.com/edunola13/uiservices-api-php', 'Descargar API PHP', TRUE, 'info') ?>
                    <?php Tags::link('', 'http://www.edunola.com.ar/blog/post/UI-Services-___-Ejemplo-API-PHP', 'Ejemplo', TRUE); ?>
                </div>
                <div class="col col-sm-4" style="display:flex;justify-content:center;align-items:center; margin-bottom: 5px;">
                    <?php Tags::link('', 'https://github.com/edunola13/uiservices-api-java', 'Descargar API Java', TRUE, 'info') ?>
                    <?php Tags::link('', 'http://www.edunola.com.ar/blog/post/UI-Services-___-Ejemplo-API-Java', 'Ejemplo', TRUE); ?>
                </div>
            </div>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>