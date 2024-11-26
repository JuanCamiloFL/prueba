<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog text-center" role="document" style="width: 20rem">
        <div class="modal-content">
  
            <div class="modal-header" style=" background-color: rgb(51, 122, 183)">
                <div class="col-1"></div>
                <div class="col-10">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-power-off fa-md"></i> Acceso al Sistema</h5>
                </div>
                <div class="col-1 pr-0"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
            </div>

            <form id="form_login" class="form" role="form" method="post" action="validar.php">
                <div class="modal-body" align="center">
                    <img src="imagenes/Icon_tux.png" height="100px">
                    <strong><p class="card-title"style="font-size: 14px">Ingrese sus datos de acceso</p></strong>

                    <div class="col-sm-12 input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input id="usuario" type="text" class="form-control" name="usuario" placeholder="Introduce tu e-mail" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese e-mail valido">
                    </div>

                    <div class="col-sm-12 input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Introduce tu password" required pattern="[_.0-9A-Za-z\s]{2,20}" title="Unicamente Caracteres Alfanumericos">
                    </div>

                    <div class="col-sm-12">
                        <h5 class="mb-0" style="color:green; font-size: 12px;">Contacte al administrador para obtener sus credenciales de acceso</h5>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-sm-12 mb-2">
                        <button class="btn btn-primary" style="width: 7rem" type="submit">Ingresar</button>
                        <a data-dismiss="modal" class="btn btn-danger text-white"style="width: 7rem">Cancelar</a>    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- código JS propìo--> 
<script type="text/javascript" src="js/login.js"></script>