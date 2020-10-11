<?php
header('Content-Type: application/json');

require_once 'ControllerJson.php';
//include 'ControllerPqr.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $codificado = file_get_contents("php://input"); 
    $_POST = json_decode($codificado, true);
    $newUser = new ControllerUser();
    $Result = $newUser->createUserController();
    if($_POST ===''){
        $Message = array("Response"=>"Usuario No se Registro.");
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"Usuario Registrado.",
            "usuario"=>$Result
        );
        echo json_encode($Message);
    }
}


elseif($_SERVER['REQUEST_METHOD']=='GET'){
    $obtener = file_get_contents("php://input");  
    $_GET = json_decode($obtener, true);
                
    $getUser = new ControllerUser();
    $Result = $getUser->readUsuariosController();
    if($_GET ===''){
        $Message = array("Response"=>"Usuario No Registrado.");
        echo json_encode($Message);
        }
    else{
        $Message = array(
            "Response"=>"Usuario Registrado.",
            "Usuario"=>$Result
        );
        echo json_encode($Message);
    }
}


elseif($_SERVER['REQUEST_METHOD']=='PUT'){
    $_GET = json_decode(file_get_contents("php://input"), true);
    $putUser = new ControllerUser();
    $Result = $putUser->updateUserController();
    if($_GET ===''){
        $Message = array("Response"=>"Usuario No Actualizado.");
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"Usuario Actualizado.",
            "usuario"=>$Result
        );
        echo json_encode($Message);
    }
}


elseif($_SERVER['REQUEST_METHOD']=='DELETE'){
    $obtener = file_get_contents("php://input");  
    $_GET = json_decode($obtener, true);
        
    $delUser = new ControllerUser();
    $Result = $delUser->deleteUsuarioController();
    if($obtener ===''){
        $Message = array("Response"=>"Usuario No Eliminado.");
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"Usuario Eliminado.",
            "Usuario"=>$Result
        );
        echo json_encode($Message);
    } 
}

?>