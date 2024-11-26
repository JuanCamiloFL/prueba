$('#form_login').submit(function(e){ 
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());
    var password = $.trim($("#password").val());

    if(usuario.length == "" || password == "") {
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Ingrese un usuario y/o paswword',
            showConfirmButton: false,
            timer: 2500
        });
        return false;
    }
    else{
        $.ajax({
            url: "/Proyecto Camilo/login/validar.php",
            data: {usuario:usuario, password:password},
            type: "POST",
            datatype:"json",
            success: function(data){
                if(data == "null"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuario y/o password incorrecto',
                    });
                } 
                else if(data == "1"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ingrese usuario',
                    });
                } 
                else if(data == "2"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ingrese e-mail valido',
                    });
                }
                else if(data == "3"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ingrese password',
                    });
                }
                else if(data == "4"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ingrese caracteres validos',
                    });
                }
                else if(data == "5"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido Administrador',
                        confirmButtonColor: '#27AE60',
                        confirmButtonText: 'Ingresar',
                    }).then((result)=>{
                        if(result.value){
                            window.location.href = "/Proyecto Camilo/empleados.php"; 
                        }
                    });
                } 
                else if(data == "6"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido Usuario',
                        confirmButtonColor: '#C0392B',
                        confirmButtonText: 'Ingresar',
                    }).then((result)=>{
                        if(result.value){
                            window.location.href = "/Proyecto Camilo/index.php"; 
                        }
                    });
                } 
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Verifique Datos Ingresados',
                        confirmButtonColor: '#3085D6',
                        // confirmButtonText: 'Ingresar',
                    }).then((result)=>{
                        if(result.value){
                            window.location.href = "/Proyecto Camilo/index.php"; 
                        }
                    })
                }
            }
        });
    }
});

//SELECCION OPCION RESPONDER E-MAIL
$("#export").click(function(){
    // FORZAMOS RESET DE LOS INPUT
    $("#form_login").trigger("reset");
    // REMOVEMOS LA CLASE INVALID PARA QUE NO APAREZCA EN MODAL
    $("#usuario").removeClass("is-invalid");
    $("#password").removeClass("is-invalid");
            
});