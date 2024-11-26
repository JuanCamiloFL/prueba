<!doctype html>
<html lang="en">

<head>
    <?php 
        include('includes/links.php')
    ?>
</head>

<body>

    <header>
    <?php 
        include('includes/menuPublico.php')
    ?>
    </header>

<!-- Page Content -->
<div class="container">
    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="pb-1 mt-4 mb-2 border-bottom">
                <h1>Administracion Empleados</h1>
            </div>
            <div class="mb-5">
                <h6>Bienvenidos al Sistema de Administracion de Empleados</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        
                        <div class="card-body mt-0">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <iframe width="460" height="315" src="https://www.youtube.com/embed/BU4x2sRBc0s?si=UXJqLv5iVAofpzvd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>

                                <div class="col-md-6 text-center">      
                                    <h4 class="media-heading">Administracion del Talento</h4>
                                    <p class="text-justify">En administración, recursos humanos (RRHH) es el área que se ocupa de todo lo concerniente al personal que labora en una organización, y a las dinámicas necesarias para su formación, estímulo, jerarquización, etc.</p>
                                    <p class="text-justify">La administración de los recursos humanos tiene como objetivo la construcción del personal que compone una organización. Para ello, capta la gente más idónea para las demandas laborales que presente. Además gestiona las dinámicas y los mecanismos de orientación, motivación, redistribución e instrucción de dicho equipo humano.</p>
                                </div>  
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="page-header">Importancia de la administración del recurso humano</h2>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-justify">CEn el vibrante contexto mundial, en el que las empresas navegan por un entorno dinámico y competitivo, la administración de recursos humanos emerge para el éxito sostenible. Más allá de la mera gestión de personal, esta función empresarial se convierte en una estrategia clave para desatar el potencial del talento humano, impulsando la innovación, la productividad y la rentabilidad a largo plazo. En Latinoamérica, esta realidad cobra aún más relevancia, donde la gestión eficaz de los recursos humanos no solo favorece el éxito empresarial, sino que también contribuye al desarrollo económico y social de la región. Por ello, es necesario saber de qué se trata la administración de recursos humanos y por qué es importante.</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img class="img-responsive rounded-pill" src="imagenes/r_humano.webp" width="350" height="200"  alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('.modal').each(function () {
        const modalId = `#${$(this).attr('id')}`;
        if (window.location.href.indexOf('#exampleModal') !== -1) {
            $('#exampleModal').modal('show');
        }
    });
});
</script>


    
<?php
    include('includes/footer.php');
?>

</body>

</html>