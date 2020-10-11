<?php
header('Content-Type: application/json');
require_once 'controllerjson.php';

if($_SERVER['REQUEST_METHOD']='POST'){
    $obtener = file_get_contents("php://input");  
    $_GET = json_decode($obtener, true);
        
    $getUser = new ControllerUser();
    $qwe = $getUser->loginUsuarioController();
    if($_GET ===''){
        $Message = array(
            "Response" => "Peticion No Aceptada."
        );
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"Peticion Aceptada.",
            "token" => sha1(uniqid(rand(),true)),
            "Usuario" => $qwe
        );
        setcookie("tkn",$Message['token'],time()+(60*30),"/");
        setcookie("firstName",$qwe['nombre_usuario'],time()+(60*30),"/");
        setcookie("secondName",$qwe['segnom_usuario'],time()+(60*30),"/");
        setcookie("id",$qwe['num_usuario'],time()+(60*30),"/");
        setcookie("tipid",$qwe['fk_tipodocumentoid_documento'],time()+(60*30),"/");
        setcookie("rol",$qwe['fk_rolid_rol'],time()+(60*30),"/");
        echo json_encode($Message);
        //echo json_encode($qwe);
    }
}else{
    http_response_code(404);
}

?>