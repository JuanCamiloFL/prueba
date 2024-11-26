<?php
session_start();
include_once '../conexion/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

if(isset($_POST['usuario'])){
			
	$usuario = ($_POST['usuario']);
	$password = ($_POST['password']);

	$consulta = ("SELECT * FROM usuarios WHERE nombre_usuario= :usuario AND pass_usuario= :password LIMIT 1");
	$resultado = $conexion->prepare($consulta);
    $resultado->bindParam("usuario", $usuario, PDO::PARAM_STR);
    $resultado->bindParam("password", $password, PDO::PARAM_STR);   
    $resultado->execute();

    if($usuario==""){
        $code = 1;
        $data=$code;
    }
    
    else if(!preg_match('/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i', $usuario)){
        $code = 2;
        $data=$code;
    }

    else if(!preg_match('/[_.0-9a-zA-Z\t\h]+|(^$)/', $password)){
        $code = 3;
        $data=$code;
    }

    else if($password==""){
        $code = 4;
        $data=$code;
    }
            
    else if ($resultado->rowCount()>=1){

    	$data=$resultado->fetch(PDO::FETCH_ASSOC);  

		$_SESSION["nombre_usuario"] = $data['nombre_usuario']; 
	  	$_SESSION["id_nivel"] = $data['id_nivel']; 
	  	$_SESSION["codigo_usuario"] = $data['codigo_usuario']; 
	  	
	  	if ($_SESSION["id_nivel"] == 1) {
	  		$data=5;
		  	}
		  	
	  	elseif ($_SESSION["id_nivel"] == 2) {
	  		$data=6;
		  	}
		  	
	  	else {
	  		$data=null;
			}
   	    }
		  
	else {
	  	$_SESSION["id_nivel"] = null;
	  	$data=null;
		  }
		}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;

?>