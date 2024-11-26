pdfMake.fonts = {
        Nunito: {
                normal: 'Nunito-Regular.ttf',
                bold: 'Nunito-Bold.ttf',
                italics: 'Nunito-Italic.ttf',
                bolditalics: 'Nunito-BoldItalic.ttf'
        }
};

$(document).ready(function() {
var id_empleado, opcion;

opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    "language": {
            "lengthMenu":"Mostrar _MENU_ registros",
            "search" : "Buscar",
            "zeroRecords": "Lo sentimos. No se encontraron registros",
            "info": "Mostrando _START_ a _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No hay registros aún.",
            "infoFiltered": "(filtrados de un total de _MAX_ registros)",
            "LoadingRecords": "Cargando ...",
            "Processing": "Procesando...",
            "SearchPlaceholder": "Comience a teclear...",
            "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente", 
                        }
                },
       
    "ajax":{            
            "url": "crud.php", 
            "method": 'POST',
            "data":{opcion:opcion}, //SE ENVIA OPCION 4 PARA HACER EL FULL SELECT
            "dataSrc":""
                },

    "columns":[
            {"data": "id_empleado", "className": "sorting_1"},
            {"data": "nombre_empleado"},
            {"data": "apellido_empleado"},
            {"data": "cedula_empleado"},
            {"data": "correo_empleado"},
            {"data": "telefono_empleado", "className": "text-center"},
            {"data": "direccion_empleado"},
            {"data": "f_nacimiento", "className": "text-center"},
            {"data": "estado_empleado", "className": "text-center"},
            {"data": "id_grupo", "className": "sorting_1"},
            {"data": "numero_grupo", "className": "text-center"},
            {"data": "id_nivel", "className": "sorting_1"},
            {"data": "nombre_nivel", "className": "sorting_1"},
            {"data": "foto_empleado", 
            "render":function(data,type,row){
                var data_n = data.split("/");
                return '<a href="'+"../"+"../"+"../"+data_n[1]+"/"+data_n[2]+"/"+data_n[3]+"/"+data_n[4]+'" class="a_href" data-toggle="lightbox" data-title="'+row["cedula_empleado"]+'" data-footer="'+row["nombre_empleado"]+" "+row["apellido_empleado"]+'" data-max-width="280"><center><img class="rounded img_fluid" src="'+"../"+"../"+"../"+data_n[1]+"/"+data_n[2]+"/"+data_n[3]+"/"+data_n[4]+'" /width="65" height="75"></center></a>'
            } },
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-info btn-sm btnEditar'><i class='material-icons' style='font-size:20px'>edit</i></button><button title='Eliminar' class='btn btn-danger btn-sm btnBorrar'><i class='material-icons' style='font-size:20px'>delete</i></button></div></div>"}
            ],

    // "order": [[ 1, "desc" ]],

        sort: false,
        responsive: true,
        dom: '<"top"l><"row justify-content-between"Bsf">rt<"row justify-content-between"ip>',    
        
    "buttons":[ 
                
            {extend:    'print',
             titleAttr: 'Imprimir',
             className: 'btn btn-info mr-2',
             text:      '<span class="material-icons align-top" style="font-size:20px">print</span> Imprimir Listado'},

            {text: '<i class= "material-icons align-top" style="font-size:20px">library_add</i> Nuevo Empleado',
             className: 'btn btn-success btnmodal',
             titleAttr: 'Nuevo',
             action: function () { 
                    },
                },
            ],
    });

// VOLVER A ACTIVAR EL MODAL DE LA FOTO CON SU CURSOR Y ACTION 
$("#modalCRUD").on('hidden.bs.modal', function () {
    $(".a_href").css("pointer-events", "auto");
    $(".a_href").css("cursor", "pointer");  
    });

// SUBMIT PARA ENVIAR DATOS DE REGISTRO - UPDATE
$('#formUsuarios').submit(function(e){                         
    e.preventDefault();
    var f_nacimiento = $.trim($('#carnet').val());  
    var nombre_empleado = $.trim($('#nombre').val());
    var apellido_empleado = $.trim($('#apellido').val());    
    var cedula_empleado = $.trim($('#cedula').val());    
    var correo_empleado = $.trim($('#correo').val());
    var telefono_empleado = $.trim($('#telefono').val());
    var direccion_empleado = $.trim($('#direccion').val());
    var estado_empleado = $.trim($('#estado').val());
    var id_grupo = $.trim($('#grupo').val());
    var id_nivel = $.trim($('#nivel').val());
    var foto_empleado = $('#image')[0].files[0];
    var form = new FormData();
            form.append('opcion', opcion);
            form.append('id_empleado', id_empleado);
            form.append('f_nacimiento', f_nacimiento);
            form.append('nombre_empleado', nombre_empleado);
            form.append('apellido_empleado', apellido_empleado);
            form.append('cedula_empleado', cedula_empleado);
            form.append('correo_empleado', correo_empleado);
            form.append('telefono_empleado', telefono_empleado);
            form.append('direccion_empleado', direccion_empleado);
            form.append('estado_empleado', estado_empleado);
            form.append('id_grupo', id_grupo);
            form.append('id_nivel', id_nivel);
            form.append('foto_empleado', foto_empleado);
            $.ajax({
            url: "crud.php",
            data: form,
            cache: false,
            contentType: false,
            processData: false,   
            type: "POST",
            datatype:"json",
            success: function(data){
                if(data == "1"){
                    $("#carnet").addClass("is-invalid");
                }
                else if(data == "2"){
                    $("#nombre").addClass("is-invalid");
                    $("#name").text("Ingrese Nombre");
                }
                else if(data == "3"){
                    $("#nombre").addClass("is-invalid");
                    $("#name").text("Ingrese unicamente letras");
                }
                else if(data == "4"){
                    $("#apellido").addClass("is-invalid");
                    $("#lastName").text("Ingrese Apellido");
                }
                else if(data == "5"){
                    $("#apellido").addClass("is-invalid");
                    $("#lastName").text("Ingrese unicamente letras");
                }
                else if(data == "6"){
                    $("#cedula").addClass("is-invalid");
                    $("#idDoc").text("Ingrese Cedula");
                }
                else if(data == "7"){
                    $("#cedula").addClass("is-invalid");
                    $("#idDoc").text("Ingrese unicamente numeros");
                }
                else if(data == "8"){
                    $("#cedula").addClass("is-invalid");
                    $("#idDoc").text("Minimo 7 - maximo 15 numeros");
                }
                else if(data == "9"){
                    $("#correo").addClass("is-invalid");
                    $("#mail").text("Ingrese Correo");   
                }
                else if(data == "10"){
                    $("#correo").addClass("is-invalid");
                    $("#mail").text("Ingrese correo valido");
                }
                else if(data == "11"){
                    $("#telefono").addClass("is-invalid");
                    $("#phone").text("Ingrese numero telefonico");
                }
                else if(data == "12"){
                    $("#telefono").addClass("is-invalid");
                    $("#phone").text("Ingrese unicamente numeros");
                }
                else if(data == "13"){
                    $("#telefono").addClass("is-invalid");
                    $("#phone").text("10 numeros unicamente");
                }
                else if(data == "14"){
                    $("#direccion").addClass("is-invalid");
                }
                else if(data == "15"){
                    $("#estado").addClass("is-invalid");
                    $("#state").text("Seleccione Estado");
                }
                else if(data == "16"){
                    $("#estado").addClass("is-invalid");
                    $("#state").text("Unicamente la seleccion");
                }
                else if(data == "17"){
                    $("#grupo").addClass("is-invalid");
                    $("#group").text("Seleccione Grupo");
                }
                else if(data == "18"){
                    $("#grupo").addClass("is-invalid");
                    $("#group").text("Unicamente la seleccion");
                } 
                else if(data == "19"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Correo ya existe',
                    });
                }    
                else {
                    $('#modalCRUD').modal('hide');
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'El registro ha sido guardado',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                tablaUsuarios.ajax.reload(null, false);
            }
        });
    });

//LIMPIAR CAMPOS ANTES DE REGISTRAR USUARIO
$(".btnmodal").click(function(registrar){
    opcion = 1; //REGISTRO           
    id_estudiante=null;

    $("#formUsuarios").trigger("reset");
    $("#imagenes").html("");
    $("#data_texto").text("");
    $("#bord_img").hide();
    // REMOVEMOS LA CLASE INVALID PARA QUE NO APAREZCA EN MODAL
    $("#carnet").removeClass("is-invalid");
    $("#nombre").removeClass("is-invalid");
    $("#apellido").removeClass("is-invalid");
    $("#cedula").removeClass("is-invalid");
    $("#correo").removeClass("is-invalid");
    $("#telefono").removeClass("is-invalid");
    $("#direccion").removeClass("is-invalid");
    $("#estado").removeClass("is-invalid");
    $("#grupo").removeClass("is-invalid");
    $("#nivel").removeClass("is-invalid");
    // ATRIBUTOS DEL MODAL
    $(".modal-header").css("background-color", "#337AB7");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Registrar Estudiante");
    $("#btnGuardar").text("Guardar");
    $('#modalCRUD').modal('show');	    
});

//SELECCION OPCION EDICION USUARIO        
$(document).on("click", ".btnEditar", function(){		        
    opcion = 2;//EDITAR
    fila = $(this).closest("tr");	  
    // ESTABLECEMOS VARIABLES       
    id_empleado = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre_empleado = fila.find('td:eq(1)').text();
    apellido_empleado = fila.find('td:eq(2)').text();
    cedula_empleado = fila.find('td:eq(3)').text();
    correo_empleado = fila.find('td:eq(4)').text();
    telefono_empleado = fila.find('td:eq(5)').text();
    direccion_empleado = fila.find('td:eq(6)').text();
    f_nacimiento = fila.find('td:eq(7)').text();
    estado_empleado = fila.find('td:eq(8)').text();
    id_grupo = fila.find('td:eq(9)').text();
    nombre_grupo = fila.find('td:eq(10)').text();
    id_nivel = fila.find('td:eq(11)').text();
    nombre_nivel = fila.find('td:eq(12)').text();
    foto_empleado = fila.find('td:eq(13)').html();
    // MUESTRA DATOS EN MODAL
    $("#carnet").val(f_nacimiento);
    $("#nombre").val(nombre_empleado);
    $("#apellido").val(apellido_empleado);
    $("#cedula").val(cedula_empleado);
    $("#correo").val(correo_empleado);
    $("#telefono").val(telefono_empleado);
    $("#direccion").val(direccion_empleado);
    $("#estado").val(estado_empleado);
    $("#grupo").val(id_grupo);
    $("#nivel").val(id_nivel);
    $(":file").filestyle('clear');
    // TOMO VARIABLE OBTENIDA Y MODIFICO TAMANO
    var data_img=foto_empleado;
    var data_1=foto_empleado.replace('width="65"', 'width="95"');
    var data_2=data_1.replace('height="75"', 'height="105"');
    // REEMPLAZAMOS LAS COMILLAS EN LA CADENA INICIAL OBTENIDA
    var data_3=data_img.replace(/['"]+/g, '/');
    // SEPARAMOS LA CADENA POR EL CARACTER / Y LLAMAMOS LA NUMERO #
    var data_4=data_3.split("/");
    $("#imagenes").html(data_2);
    $("#data_texto").text(data_4[7]);
    $("#bord_img").show();
    // QUITAMOS EL ATRIBUTO DE REFERENCIA EN LA FOTO
    $('.a_href').css("pointer-events", "none");
    $('.a_href').css("cursor", "default");
    // REMOVEMOS LA CLASE INVALID PARA QUE NO APAREZCA EN MODAL
    $("#carnet").removeClass("is-invalid");
    $("#nombre").removeClass("is-invalid");
    $("#apellido").removeClass("is-invalid");
    $("#cedula").removeClass("is-invalid");
    $("#correo").removeClass("is-invalid");
    $("#telefono").removeClass("is-invalid");
    $("#direccion").removeClass("is-invalid");
    $("#estado").removeClass("is-invalid");
    $("#grupo").removeClass("is-invalid");
    $("#nivel").removeClass("is-invalid");
    // ATRIBUTOS DEL MODAL
    $(".modal-header").css("background-color", "#337AB7");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Estudiante");
    $("#btnGuardar").text("Actualizar");		
    $('#modalCRUD').modal('show');		   
});

//ELIMINAR REGISTROS
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    id_empleado = parseInt($(this).closest('tr').find('td:eq(0)').text());	
    nombre_empleado = ($(this).closest('tr').find('td:eq(1)').text());   
    apellido_empleado = ($(this).closest('tr').find('td:eq(2)').text());   	
    opcion = 3; //ELIMINAR        
        Swal.fire({
          title: '¿Está seguro de borrar a <h5 style="color:#C70039">'+nombre_empleado+' '+apellido_empleado+'?</h5>',
          text: "Esta accion no puede revertirse!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "crud.php",
                    type: "POST",
                    datatype:"json",    
                    data:  {opcion:opcion, id_empleado:id_empleado},    
                    success: function() {
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                        }
                    }); 
                    Swal.fire(
                        'Borrado!',
                        'El registro ha sido eliminado.',
                        'success'
                        )
                }
        })

    });
    
});
// HACER QUE LAS FOTOS TENGAN ZOOM EN LA TABLA PRINCIPAL
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });