<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include('includes/links.php')
    ?>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <!-- Imagen del Proyecto -->
    <!-- <link href="/Proyecto Camilo/imagenes/sitio-web.png" rel="shortcut icon" type="image/x-icon"> -->
    <!-- <title>Proyecto JrDesign</title> -->
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css"> -->
    <!-- CSS personalizado --> 
    <!-- <link rel="stylesheet" href="assets/css_alumnos.css">       -->
    <!-- CSS para iconos menu -->
    <!-- <link rel="stylesheet" href="font/openiconic/css/open-iconic.css"> -->
    <!-- <link rel="stylesheet" href="font/fontawesome/css/all.css"> -->
    <!-- <link rel="stylesheet" href="font/fontBoostrap/bootstrap-icons.css"> -->
    <!--Iconos de Google-->    
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <!-- Estilos para despliegue del menu -->
    <!-- <script src="assets/jquery/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- Botones de alerta -->
    <!-- <script src="assets/sweetalert/sweetalert2.all.min.js"></script> -->

</head>

<body>
     <header>
    <?php 
        include('includes/menuPublico.php')
    ?>
    </header>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-lg-12">
            <div class="col-md-6 row justify-content-start"><h3><b>Contacto</b></h3></div>
            </div>
        </div>
    </div>

    <div class="container">   
        <div class="row">
           <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contacto</li>
                    </ol>
                </nav>
            </div>
        </div> 
    

        <div class="row">
            <div class="col-lg-12">
                 <div class="card">
                    <div class="col-md-12 mt-3">

                        <div class="row align-items-center">
                            <div class="col-md-6 text-right">
                                <!-- Embedded Google Map -->
                                <iframe width="100%" height="350px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15864.06603168792!2d-75.5975302213548!3d6.2615553571699385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sco!4v1629394302898!5m2!1ses!2sco" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>

                            <div class="col-md-4">
                                <h3>Detalles de Contacto</h3>
                                <p>Administracion Emresarial JFK<br>Medellin - Antioquia</p>
                                
                                <p><span class="material-icons align-top" style="font-size:20px; color:#333f">phone_in_talk</span>
                                    <abbr title="Phone">Telefono</abbr>: 604-3345674
                                </p>
                                
                                <p><span class="material-icons align-top" style="font-size:20px; color:#333f">attach_email</span>
                                    <abbr title="Email">Email</abbr>: <a href="mailto:romanosatelite1@gmail.com">recursosdesign@une.com</a>
                                </p>

                                <p><span class="material-icons align-top" style="font-size:20px; color:#333f">schedule</span>
                                    <abbr title="Hours">Horario</abbr>: Lunes a Viernes: 8:00 AM - 5:00 PM
                                </p>
                                
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-facebook-square fa-2x" style="color:#286090"></i></a>
                                    </li>
                                    
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
                                    </li>
                                    
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-twitter-square fa-2x" style="color:#26a1ab"></i></a>
                                    </li>
                                    
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-google-plus-square fa-2x" style="color:#e12330"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <h3>Envianos tu mensaje</h3>
                                <form id="formUsuarios" class="form-group mb-0" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Nombre Completo:</label>
                                            <input type="text" class="form-control" id="remitente" name="remitente" required pattern="[A-Za-z\s]{2,20}" title="Unicamente letras">
                                            <div id="vRemitente" class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Asunto:</label>
                                            <input type="text" class="form-control" id="asunto" name="asunto" required pattern="[0-9A-Za-z\s]{2,20}" title="Unicamente letras - numeros">
                                            <div id="vAsunto" class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Correo Electronico:</label>
                                            <input type="email" class="form-control" id="correo" name="correo" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese e-mail valido">
                                            <div id="vCorreo" class="invalid-feedback"></div>  
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Mensaje:</label>
                                            <textarea rows="4" class="form-control" id="mensaje" name="mensaje" style="resize:none" maxlength="300" required pattern="[0-9A-Za-z\s]{2,300}" title="Unicamente letras"></textarea>
                                            <div id="vMensaje" class="invalid-feedback"></div>  
                                        </div>
                                    </div>

                                    <button type="reset" id="btnReset" class="btn btn-success">Limpiar</button>
                                    <button type="submit" id="btnGuardar" class="btn btn-primary">Enviar Mensaje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <!-- Datatables JS -->
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <!-- Usar botones en datatables JS -->  
    <script src="assets/Buttons-1.7.1/js/dataTables.buttons.min.js"></script>  
    <script src="assets/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="assets/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="assets/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="assets/Buttons-1.7.1/js/buttons.html5.min.js"></script>
    <!-- Para el select de archivo en el Form -->
    <script type="text/javascript" src="assets/lightbox/bootstrap-filestyle.min.js"></script>
    <!-- PROBANDO ZOOM IMAGEN -->
    <script type="text/javascript" src="assets/lightbox/ekko-lightbox.min.js"></script>
    <!-- código JS propìo--> 
    <script type="text/javascript" src="js/contacto_mensajes.js"></script>

<?php
    include('includes/footer.php');
 ?>
</body>
</html>