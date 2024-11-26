<?php
include_once 'conexion/conexion.php';

$conexion   = Conexion::Conectar();

$opcion     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_empleado= (isset($_POST['id_empleado'])) ? $_POST['id_empleado'] : '';

$carnet     = (isset($_POST['f_nacimiento'])) ? $_POST['f_nacimiento'] : '';
$nombre     = (isset($_POST['nombre_empleado'])) ? $_POST['nombre_empleado'] : '';
$apellido   = (isset($_POST['apellido_empleado'])) ? $_POST['apellido_empleado'] : '';
$cedula     = (isset($_POST['cedula_empleado'])) ? $_POST['cedula_empleado'] : '';
$correo     = (isset($_POST['correo_empleado'])) ? $_POST['correo_empleado'] : '';
$telefono   = (isset($_POST['telefono_empleado'])) ? $_POST['telefono_empleado'] : '';
$direccion  = (isset($_POST['direccion_empleado'])) ? $_POST['direccion_empleado'] : '';
$estado     = (isset($_POST['estado_empleado'])) ? $_POST['estado_empleado'] : '';
$grupo      = (isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
// $hash       = password_hash($cedula, PASSWORD_DEFAULT);
$nivel      = (isset($_POST['id_nivel'])) ? $_POST['id_nivel'] : '';

switch($opcion){
    case 1: // INSERTAR REGISTROS EN LA BASE DE DATOS

    // VALIDACION DE DATOS DEL FORMULARIO
    if($carnet==""){
        $code = 1;
        $data=$code;
    break;
    }
    // VALIDACION NOMBRES FORMULARIO
    else if(empty($nombre)){
        $code = 2;
        $data=$code;
        break;
    }
    else if(!preg_match('/[a-zA-Z\t\h]+|(^$)/', $nombre)){
        $code = 3;
        $data=$code;
        break;
    }
    // VALIDACION APELLIDOS FORMULARIO
    else if($apellido==""){
        $code = 4;
        $data=$code;
        break;
    }
    else if(!preg_match('/[a-zA-Z\t\h]+|(^$)/', $apellido)){
        $code = 5;
        $data=$code;
        break;
    }
    // VALIDACION CEDULA FORMULARIO
    else if($cedula==""){
        $code = 6;
        $data=$code;
        break;
    }
    else if(!is_numeric($cedula)){
        $code = 7;
        $data=$code; 
        break;
    }
    else if(strlen($cedula)<7 || strlen($cedula)>15) {
        $code = 8;
        $data=$code;
        break;
    }
    // VALIDACION CORREO FORMULARIO
    else if($correo==""){
        $code = 9;
        $data=$code;
        break;
    }
    else if(!preg_match('/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i', $correo)){
        $code = 10;
        $data=$code;
        break;
    }
    // VALIDACION TELEFONO FORMULARIO
    else if($telefono==""){
        $code = 11;
        $data=$code;
        break;
    }
    else if(!is_numeric($telefono)){
        $code = 12; 
        $data=$code;
        break;
    }
    else if(strlen($telefono)<7 || strlen($telefono)>10) {
        $code = 13;
        $data=$code;
        break;
    }
    // VALIDACION DIRECCION FORMULARIO
    else if($direccion==""){
        $code = 14;
        $data=$code;
        break;
    }
    // VALIDACION ESTADO FORMULARIO
    else if($estado==""){
        $code = 15;
        $data=$code;
        break;
    }
    else if(!is_numeric($estado)){
        $code = 16; 
        $data=$code;
        break;
    }
    // VALIDACION GRUPO FORMULARIO
    else if($grupo==""){
        $code = 17;
        $data=$code;
        break;
    }
    else if(!is_numeric($grupo)){
        $code = 18; 
        $data=$code;
        break;
    }   
    // VERIFICAMOS QUE NO EXISTA EL CORREO EL CUAL SERA EL USER DEL LOGIN
    $consulta   = "SELECT * FROM usuarios WHERE nombre_usuario=:correo_empleado";
    $resultado  = $conexion->prepare($consulta);
    $resultado  ->bindParam(':correo_empleado',$correo);
    $resultado  ->execute();
    $numExistRows = $resultado->fetchColumn();
             
    if($numExistRows > 0){
        $code = 19;
        $data = $code;
        break;
    }
    // VERIFICAR SI ENVIARON FOTO Y MOVERLA A CARPETA
    if (isset($_FILES['foto_empleado'])) {
        $tipo         = $_FILES['foto_empleado']['type'];
        $rutatemporal = $_FILES['foto_empleado']['tmp_name'];
        $rutaservidor = 'imagenes/usuarios/';
        $nombrefoto   = 'est_'.date('YmdHi') .'.'. pathinfo($_FILES['foto_empleado']['name'],PATHINFO_EXTENSION);
        $save         = $rutaservidor . $nombrefoto;
        $foto         = '/Proyecto Camilo/imagenes/usuarios'.'/'.$nombrefoto;
        
        if (($tipo == "image/jpeg") || ($tipo == "image/png") || ($tipo == "image/jpg")) {
            move_uploaded_file($rutatemporal, $save);
            }
        }
        else {
            $foto   = '/Proyecto Camilo/imagenes/usuarios/images.jpg';
        }
        // INGRESAR DATOS A TABLA RESPECTIVA
        $consulta   = "INSERT INTO empleados (f_nacimiento, nombre_empleado, apellido_empleado, cedula_empleado, correo_empleado, telefono_empleado, direccion_empleado, estado_empleado, id_grupo, foto_empleado) VALUES (:f_nacimiento, :nombre_empleado, :apellido_empleado, :cedula_empleado, :correo_empleado, :telefono_empleado, :direccion_empleado, :estado_empleado, :id_grupo, :foto_empleado)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':f_nacimiento',$carnet);
        $resultado  ->bindParam(':nombre_empleado',$nombre);
        $resultado  ->bindParam(':apellido_empleado',$apellido);
        $resultado  ->bindParam(':cedula_empleado',$cedula);
        $resultado  ->bindParam(':correo_empleado',$correo);
        $resultado  ->bindParam(':telefono_empleado',$telefono);
        $resultado  ->bindParam(':direccion_empleado',$direccion);
        $resultado  ->bindParam(':estado_empleado',$estado);
        $resultado  ->bindParam(':id_grupo',$grupo);
        $resultado  ->bindParam(':foto_empleado',$foto);
        $resultado  ->execute();
     
        $consulta   = "SELECT id_empleado FROM empleados WHERE cedula_empleado=:cedula_empleado AND correo_empleado=:correo_empleado";
        $resultado  = $conexion->prepare($consulta);    
        $resultado  ->bindParam(':cedula_empleado',$cedula);
        $resultado  ->bindParam(':correo_empleado',$correo);              
        $resultado  ->execute();

        while($filas=$resultado->fetch(PDO::FETCH_ASSOC)){
        $codigo_empleado=$filas['id_empleado'];                           
        }    

        $consulta   = "INSERT INTO usuarios (nombre_usuario, pass_usuario, id_nivel, codigo_usuario, estado_usuario, foto_usuario) VALUES (:nombre_usuario, :pass_usuario, :id_nivel, :codigo_usuario, :estado_usuario, :foto_usuario)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':nombre_usuario',$correo);
        $resultado  ->bindParam(':pass_usuario',$cedula);
        $resultado  ->bindParam(':id_nivel',$nivel);
        $resultado  ->bindParam(':codigo_usuario',$codigo_empleado);
        $resultado  ->bindParam(':estado_usuario',$estado);
        $resultado  ->bindParam(':foto_usuario',$foto);
        $resultado  ->execute(); 
        // ACTUALIZAR TENIENDO EN CUENTAS PRIMERAS LETRAS EN MAYUSCULA
        $consulta   = "UPDATE empleados SET nombre_empleado = UC_Words(nombre_empleado), apellido_empleado = UC_Words(apellido_empleado), direccion_empleado = UC_Words(direccion_empleado)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();  

        $consulta   = "UPDATE empleados SET correo_empleado = LCASE(correo_empleado)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();

        $consulta   = "UPDATE usuarios SET nombre_usuario = LCASE(nombre_usuario)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();
        // LISTAR Y MOSTRAR TODOS LOS DATOS DE LA BD
        $consulta = "SELECT * FROM empleados ORDER BY id_empleado DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
        break; 

    case 2: // ACTUALIZAR REGISTROS EN LA BASE DE DATOS

    // VALIDACION DE DATOS DEL FORMULARIO
    if($carnet==""){
        $code = 1;
        $data=$code;
        break;
    }
    // VALIDACION NOMBRES FORMULARIO
    else if(empty($nombre)){
        $code = 2;
        $data=$code;
        break;
    }
    else if(!preg_match('/[a-zA-Z\t\h]+|(^$)/', $nombre)){
        $code = 3;
        $data=$code;
        break;
    }
    // VALIDACION APELLIDOS FORMULARIO
    else if($apellido==""){
        $code = 4;
        $data=$code;
        break;
    }
    else if(!preg_match('/[a-zA-Z\t\h]+|(^$)/', $apellido)){
        $code = 5;
        $data=$code;
        break;
    }
    // VALIDACION CEDULA FORMULARIO
    else if($cedula==""){
        $code = 6;
        $data=$code;
        break;
    }
    else if(!is_numeric($cedula)){
        $code = 7;
        $data=$code; 
        break;
    }
    else if(strlen($cedula)<7 || strlen($cedula)>15) {
        $code = 8;
        $data=$code;
        break;
    }
    // VALIDACION CORREO FORMULARIO
    else if($correo==""){
        $code = 9;
        $data=$code;
        break;
    }
    else if(!preg_match('/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i', $correo)){
        $code = 10;
        $data=$code;
        break;
    }
    // VALIDACION TELEFONO FORMULARIO
    else if($telefono==""){
        $code = 11;
        $data=$code;
        break;
    }
    else if(!is_numeric($telefono)){
        $code = 12; 
        $data=$code;
        break;
    }
    else if(strlen($telefono)<7 || strlen($telefono)>10) {
        $code = 13;
        $data=$code;
        break;
    }
    // VALIDACION DIRECCION FORMULARIO
    else if($direccion==""){
        $code = 14;
        $data=$code;
        break;
    }
    // VALIDACION ESTADO FORMULARIO
    else if($estado==""){
        $code = 15;
        $data=$code;
        break;
    }
    else if(!is_numeric($estado)){
        $code = 16; 
        $data=$code;
        break;
    }
    // VALIDACION GRUPO FORMULARIO
    else if($grupo==""){
        $code = 17;
        $data=$code;
        break;
    }
    else if(!is_numeric($grupo)){
        $code = 18; 
        $data=$code;
        break;
    } 
 
    else {
        $consulta   = "UPDATE empleados SET f_nacimiento=:f_nacimiento, nombre_empleado=:nombre_empleado, apellido_empleado=:apellido_empleado, cedula_empleado=:cedula_empleado, correo_empleado=:correo_empleado, telefono_empleado=:telefono_empleado, direccion_empleado=:direccion_empleado, estado_empleado=:estado_empleado, id_grupo=:id_grupo where id_empleado=:id_empleado";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':f_nacimiento',$carnet);
        $resultado  ->bindParam(':nombre_empleado',$nombre);
        $resultado  ->bindParam(':apellido_empleado',$apellido);
        $resultado  ->bindParam(':cedula_empleado',$cedula);
        $resultado  ->bindParam(':correo_empleado',$correo);
        $resultado  ->bindParam(':telefono_empleado',$telefono);
        $resultado  ->bindParam(':direccion_empleado',$direccion);
        $resultado  ->bindParam(':estado_empleado',$estado);
        $resultado  ->bindParam(':id_grupo',$grupo);
        $resultado  ->bindParam(':id_empleado',$id_empleado);
        $resultado  ->execute();  

        $consulta   = "UPDATE usuarios SET nombre_usuario=:correo_empleado, pass_usuario=:cedula_empleado, estado_usuario=:estado_empleado where codigo_usuario=:id_empleado AND id_nivel=:id_nivel";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':correo_empleado',$correo);
        $resultado  ->bindParam(':cedula_empleado',$cedula);
        $resultado  ->bindParam(':estado_empleado',$estado);
        $resultado  ->bindParam(':id_empleado',$id_empleado);
        $resultado  ->bindParam(':id_nivel',$nivel);
        $resultado  ->execute();

        $consulta   = "UPDATE empleados SET nombre_empleado = UC_Words(nombre_empleado), apellido_empleado = UC_Words(apellido_empleado), direccion_empleado = UC_Words(direccion_empleado)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();

        $consulta   = "UPDATE empleados SET correo_empleados = LCASE(correo_empleados)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();

        $consulta   = "UPDATE usuarios SET nombre_usuario = LCASE(nombre_usuario)";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();
      
        }

    if (isset($_FILES['foto_empleado'])) {
        $tipo         = $_FILES['foto_empleado']['type'];
        $rutatemporal = $_FILES['foto_empleado']['tmp_name'];
        $rutaservidor = 'imagenes/usuarios/';
        $nombrefoto   = 'est_'.date('YmdHi') .'.'. pathinfo($_FILES['foto_empleado']['name'],PATHINFO_EXTENSION);
        $save         = $rutaservidor . $nombrefoto;
        $foto         = '/Proyecto Camilo/imagenes/usuarios'.'/'.$nombrefoto;
       
        if (($tipo == "image/jpeg") || ($tipo == "image/png") || ($tipo == "image/jpg")) {
        move_uploaded_file($rutatemporal, $save);}

        $consulta   = "SELECT foto_empleado FROM empleados WHERE id_empleado=:id_empleado";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':id_empleado',$empleado);
        $resultado  ->execute();
        $estudiante =$resultado->fetch(PDO::FETCH_LAZY); 
        
        if(isset($estudiante["foto_empleado"])){
            if(file_exists($_SERVER["DOCUMENT_ROOT"].$estudiante["foto_empleado"])){
                if($estudiante["foto_empleado"]!="/Proyecto Camilo/imagenes/usuarios/images.jpg"){
                unlink($_SERVER["DOCUMENT_ROOT"].$estudiante["foto_empleado"]);
                }
            }
        }
        
        $consulta   = "UPDATE empleados SET foto_empleado=:foto_empleado where id_empleado=:id_empleado";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':foto_empleado',$foto);
        $resultado  ->bindParam(':id_empleado',$id_empleado);
        $resultado  ->execute();

        $consulta   = "UPDATE usuarios SET foto_usuario=:foto_usuario where codigo_usuario=:id_empleado AND id_nivel=:id_nivel";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':foto_usuario',$foto);
        $resultado  ->bindParam(':id_empleado',$id_empleado);
        $resultado  ->bindParam(':id_nivel',$nivel);
        $resultado  ->execute();
        
        }
                   
        $consulta   = "SELECT * FROM empleados WHERE id_empleado=:id_empleado";       
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam(':id_empleado',$id_empleado);
        $resultado  ->execute();
        $data       = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3: // ELIMINAR REGISTROS EN LA BASE DE DATOS
        $consulta   = "SELECT foto_empleado FROM empleados WHERE id_empleado=:id_empleado";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam('id_empleado', $id_empleado);
        $resultado  ->execute();
        $estudiante =$resultado->fetch(PDO::FETCH_LAZY); 
        // print_r($estudiante);

        if(isset($estudiante["foto_empleado"])){
            if(file_exists("C:/wamp64/www/".$estudiante["foto_empleado"])){
                if($estudiante["foto_empleado"]!="/Proyecto Camilo/imagenes/usuarios/images.jpg"){
                unlink("C:/wamp64/www/".$estudiante["foto_empleado"]);
                }
            }
        }

        $consulta   = "DELETE FROM empleados WHERE id_empleado=:id_empleado";		
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam('id_empleado', $id_empleado);
        $resultado  ->execute();     

        $consulta   = "DELETE FROM usuarios WHERE codigo_usuario=:codigo_usuario";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->bindParam('codigo_usuario', $id_empleado);
        $resultado  ->execute();   
        $data       = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 4: // LISTAR TODOS LOS REGISTROS DE LA BASE DE DATOS
        $consulta   = "SELECT id_empleado, f_nacimiento, nombre_empleado, apellido_empleado, cedula_empleado, correo_empleado, telefono_empleado, direccion_empleado, estado_empleado, empleados.id_grupo, foto_empleado, grupos.numero_grupo, usuarios.id_nivel, niveles.nombre_nivel FROM empleados JOIN grupos ON empleados.id_grupo=grupos.id_grupo JOIN usuarios ON empleados.correo_empleado=usuarios.nombre_usuario JOIN niveles ON usuarios.id_nivel=niveles.id_nivel ORDER BY id_empleado ASC";
        $resultado  = $conexion->prepare($consulta);
        $resultado  ->execute();        
        $data       = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;

?>