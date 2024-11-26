<?php
session_start();
include_once 'conexion/conexion.php';

$conexion=Conexion::Conectar();

if(isset($_SESSION['nombre_usuario'])) {
    if ($_SESSION["id_nivel"] == 1) {
        $user = $_SESSION['nombre_usuario'];
        $codigo = $_SESSION["codigo_usuario"];

        $consulta   = "SELECT foto_usuario FROM usuarios WHERE codigo_usuario=:codigo_usuario";
        $resultado  = $conexion->prepare($consulta);    
        $resultado  ->bindParam(':codigo_usuario',$codigo);
        $resultado  ->execute();

        while($filas=$resultado->fetch(PDO::FETCH_ASSOC)){
        $foto=$filas['foto_usuario'];       

        }

        $consulta = "SELECT * FROM grupos";
        $grupo = $conexion->prepare($consulta);
        $grupo->execute();

        $consulta = "SELECT * FROM niveles";
        $nivel = $conexion->prepare($consulta);
        $nivel->execute();
?>

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
    include('includes/menuUsuario.php')
    ?>
    </header>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-3"><img src="imagenes/Icon_tux.png" height="80" class="img-responsive"></div>

            <div class="col-md-6 row justify-content-center"><h3><b>PANEL ADMINISTRADOR</b></h3></div>

            <div class="col-md-3 row align-items-center justify-content-end">
                <div class="img-container text-center">
                    <img class="rounded-circle border" src="<?php echo $foto ?>" width="60px" height="60px"/><br/><h6><b> Online: </b><?php echo $user ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
           <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="../admin.php">Administrador</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                    </ol>
                </nav>
            </div>
        </div> 
      
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0" style="height: 1.5rem;" >
                        <center><h5><b>Administracion de Empleados</b></h5></center>
                        </div>
                    </div>

                    <div class="card-body mt-0">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="table-responsive">        
                                    <table id="tablaUsuarios" class="table table-striped table-hover table-responsive table-sm" style="width:100%" >
                                        <thead class="text-center">
                                            <tr>
                                                <th class="hide_me" rowspan="1" colspan="1" >Id</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="15%">Nombres</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="15%">Apellidos</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="10%">Cedula</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="15%">Correo</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="10%">Telefono</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="14%">Direccion</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="10%">F. Nacimiento</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="8%">Estado</th>
                                                <th class="hide_me" rowspan="1" colspan="1" >Id Grupo</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" width="8%">Dependencia</th>
                                                <th class="hide_me" rowspan="1" colspan="1" >Id Nivel</th>
                                                <th class="hide_me" rowspan="1" colspan="1" >Acceso</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" >Foto</th>
                                                <th class="sorting_disabled p-2" rowspan="1" colspan="1" >Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>        
                                    </table>               
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUsuarios" class="form-group mb-0" method="POST" enctype="multipart/form-data">    
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="col-md-12 ">
                                    <div id="bord_img" class="col-md-12 border rounded pt-2 mt-2" style="background: #EBEDEF;">
                                        <div class="imagenes" id="imagenes"></div>
                                        <div class="col-md-12 text-center">
                                            <h7 id="data_texto" class="text-primary"></h7>
                                        </div>
                                    </div>  
                                </div>
                            </div>    

                            <div class="col-md-6 pr-0">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" required pattern="[A-Za-z\s]{2,20}" title="Unicamente letras">
                                    <div id="name" class="invalid-feedback"></div>                                
                                </div>
                            </div>    
                   
                            <div class="col-md-6 pl-0">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" required pattern="[A-Za-z\s]{2,20}" title="Unicamente letras">
                                    <div id="lastName" class="invalid-feedback"></div>  
                                </div>   
                            </div>
                            
                            <div class="col-md-6 pr-0">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Cedula</label>
                                    <input type="text" class="form-control" id="cedula" maxlength="15" required pattern="[0-9]{7,15}" title="Unicamente numeros">
                                    <div id="idDoc" class="invalid-feedback"></div>   
                                </div>
                            </div>  
                     
                            <div class="col-md-6 pl-0">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Correo</label>
                                    <input type="email" class="form-control" id="correo" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese e-mail valido">
                                    <div id="mail" class="invalid-feedback"></div>   
                                </div>
                            </div>    

                            <div class="col-md-6 pr-0">    
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" minlength="7" maxlength="10" required pattern="[0-9]{7,10}" title="Unicamente telefono fijo o movil">
                                    <div id="phone" class="invalid-feedback"></div>   
                                </div>            
                            </div>

                            <div class="col-md-6 pl-0">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">F. Nacimiento</label>
                                    <input type="date" class="form-control" id="carnet" required>
                                    <div class="invalid-feedback">Ingrese fecha de nacimiento</div>  
                                    <div class="valid-feedback"></div>  
                                </div>
                            </div>   

                            <div class="col-md-12">    
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Direccion</label>
                                    <textarea type="text" class="form-control" rows="1" id="direccion" maxlength="150" required></textarea>
                                    <div class="invalid-feedback">Ingrese direccion</div>               
                                </div>
                            </div>

                            <div class="col-md-6 pr-0">    
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Estado</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        <option value="1" selected="">Activo</option>
                                        <option value="0">Inactivo</option>
                                        <div id="state" class="invalid-feedback"></div>   
                                    </select>
                                </div>            
                            </div>   
                            
                            <div class="col-md-6 pl-0">    
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Dependencia</label>
                                    <select class="form-control" id="grupo" name="grupo" required>
                                    <?php 
                                    while($fila=$grupo->fetch(PDO::FETCH_NUM)){
                                    echo "<option value='".$fila['0']."'>".$fila['1']."</option>";
                                    }
                                    ?>
                                    </select>
                                    <div id="group" class="invalid-feedback"></div>   
                                </div>            
                            </div>

                            <div class="col-md-6 pr-0">    
                                <div class="col-md-12">
                                    <label for="" class="col-form-label pb-0">Nivel Acceso</label>
                                    <select class="form-control" id="nivel" name="nivel" required>
                                    <?php 
                                    while($fila=$nivel->fetch(PDO::FETCH_NUM)){
                                    echo "<option value='".$fila['0']."'>".$fila['1']."</option>";
                                    }
                                    ?>
                                    </select>
                                    <div id="group" class="invalid-feedback"></div>   
                                </div>            
                            </div>

                            <div class="col-md-12">    
                                <div class="file col-md-12">
                                    <label for="" class="col-form-label pb-0">Fotografia</label>
                                    <input id="image" type="file" class="filestyle" data-input="true" data-size="sm" data-placeholder="Ningun Archivo" data-text="<span class='material-icons align-middle' style='font-size:23px'>cloud_upload</span> Elija el Archivo">
                                </div>            
                            </div> 
                        </div>                
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                    </div>
                </form>    
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
    <script type="text/javascript" src="js/main_ad_empleados.js"></script>

<?php
    include('includes/footer.php');
 ?>  

</body>

</html>

<?php
     }
     else{
        echo '<script> alert("No Tienes los permisos para acceder a esta pagina.");</script>';
        echo '<script> window.location="/Proyecto Camilo/index.php#exampleModal"; </script>';
        }
}else{
    echo '<script> window.location="/Proyecto Camilo/index.php#exampleModal"; </script>';
    }
?>