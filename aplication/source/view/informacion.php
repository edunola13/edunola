<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'sections/head.php'; ?>
</head>
<body>
    <?php $menu= "informacion"; ?>
    <?php require_once 'sections/nav.php'; ?>
    
    <div class="container">        
        <?php require_once 'sections/header.php'; ?>
    
        <section class="row">
            <article class="col col-md-2">
                <?php Tags::image("Eduardo Sebasian Nola", BASEURL . 'resources/images/foto-personal.png');?>
            </article>
            <article class="col col-md-6">
                <?php Tags::paragraph("left"); ?>
                    Soy un estudiante avanzado de la carrera Licenciatura en Sistemas 
                    de la UNLP (Universidad Nacional de La Plata) contando ya con el titulo intermedio Analista Programador
                    Universitario. Me dedico al analisis e implementacion de distintos desarrollos de Software de una manera
                    independiente o en relación de dependencia.
                <?php Tags::end_paragraph(); ?>
                <?php Tags::paragraph("left"); ?>
                    Actualmente me encuentro realizando varios desarrollos. Estoy realizando una simulacion para mi tesina de
                    Grado, trabajando como Desarrollador en Aknotec y desarrollando Enola PHP y Servicios UI.
                <?php Tags::end_paragraph(); ?>
            </article>
            <article class="col col-md-4">
                <?php Tags::panel("Información Personal"); ?>
                    Nombre: Eduardo Sebastian Nola. </br>
                    Fecha Nacimiento: Mayo 1990. </br>
                    Email de Contacto: edunola13@gmail.com </br>
                <?php Tags::end_panel(); ?>
            </article>
        </section>    
        <section class="row">
            <article class="col col-md-6">
                <?php Tags::title("Servicios Destacados"); ?>   
                <?php Tags::ul(); ?>
                    <?php Tags::li("Consultor Tecnologico"); ?>
                    <?php Tags::li("Analisis y Especificacion de Requerimientos"); ?>
                    <?php Tags::li("Desarrollo de Aplicaciones Web"); ?>
                    <?php Tags::li("Soluciones Business Intelligence"); ?>
                    <?php Tags::li("Desarrollo de Aplicaciones de Escritorio"); ?>
                    <?php Tags::li("Desarrollo de Aplicaciones para Celulares"); ?>
                    <?php Tags::li("Web Hosting"); ?>
                    <?php Tags::li("Mantenimiento de Aplicaciones"); ?>
                    <?php Tags::li("BPM (Administracion de Procesos de Negocio)"); ?>
                    <?php Tags::li("Juegos-Simulación"); ?>
                <?php Tags::end_ul(); ?>
            </article>
            <article class="col col-md-6">
                <?php Tags::title("Tecnologias Destacadas"); ?>   
                <?php Tags::ul(); ?>
                    <?php Tags::li("PHP, Twig, Smarty, CodeIgniter"); ?>
                    <?php Tags::li("JAVA, J2EE, Spring"); ?>
                    <?php Tags::li("Spring MVC, Struts2, JSF, Hibernate"); ?>
                    <?php Tags::li("HTML5, CSS3, XML, JSON, AJAX"); ?>
                    <?php Tags::li("JavaScript, JQuery"); ?>
                    <?php Tags::li("Web Services"); ?>
                    <?php Tags::li("BPM, BPMN, BonitaSoft"); ?>
                    <?php Tags::li("Portal Web, Portlets, Liferay"); ?>
                    <?php Tags::li("Mobile"); ?>
                    <?php Tags::li("Unity3D, C#"); ?>
                <?php Tags::end_ul(); ?>
            </article>
        </section>
    </div>
        
    <?php require_once 'sections/footer.php'; ?>
    
</body>
</html>