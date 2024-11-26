 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Proyecto Camilo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown">
                <a class="nav-link" href="acerca.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="bi bi-question-square-fill"></span> Acerca de</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="contacto.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="bi bi-file-earmark-person-fill"></span> Contacto</a>
            </li>

            <li class="nav-item dropdown" id="login">
                <a class="nav-link" data-toggle="modal" href="#exampleModal" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="oi" data-glyph="account-login"></span> Login</a>
            </li>
        </ul>
  </div>
</nav>

<?php 
    include('login/login.php')
?>



