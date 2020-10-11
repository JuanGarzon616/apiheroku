<?php
header('Content-Type: application/json');

require_once 'ControllerPqr.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_GET['pqr'])){
        switch($_GET['pqr']){
            case 'i':
                $codificado = file_get_contents("php://input"); 
                $_POST = json_decode($codificado, true);
                $newPqr = new ControllerPQR();
                $Result = $newPqr->createPqrController();
                if($_POST ===''){
                    $Message = array("Response"=>"PQR No se Registro.");
                    echo json_encode($Message);
                }else{
                    $Message = array(
                        "Response"=>"PQR Registrado.",
                        "PQR"=>$Result
                    );
                    echo json_encode($Message);
                }                
            break;
            case 'l':
                $obtener = file_get_contents("php://input");  
                $_GET = json_decode($obtener, true);
                            
                $getPqr = new ControllerPQR();
                $Result = $getPqr->readPqrController();
                if($_GET ===''){
                    $Message = array("Response"=>"Pqr No Registrado.");
                    echo json_encode($Message);
                    }
                else{
                    $Message = array(
                        "Response"=>"Pqr Registrado.",
                        "PQRs"=>$Result
                    );
                    echo json_encode($Message);
                }     
            break;
        }
    }

}
/*
elseif($_SERVER['REQUEST_METHOD']=='GET'){
    $obtener = file_get_contents("php://input");  
    $_GET = json_decode($obtener, true);
                
    $getPqr = new ControllerPQR();
    $Result = $getPqr->readPqrController();
    if($_GET ===''){
        $Message = array("Response"=>"Pqr No Registrado.");
        echo json_encode($Message);
        }
    else{
        $Message = array(
            "Response"=>"Pqr Registrado.",
            "PQR's"=>$Result
        );
        echo json_encode($Message);
    }
}*/


elseif($_SERVER['REQUEST_METHOD']=='PUT'){
    $_GET = json_decode(file_get_contents("php://input"), true);
    $putUser = new ControllerPqr();
    $Result = $putUser->updatePqrController();
    if($_GET ===''){
        $Message = array("Response"=>"Usuario No Actualizado.");
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"PQR Actualizado.",
            "PQR's"=>$Result
        );
        echo json_encode($Message);
    }
}


elseif($_SERVER['REQUEST_METHOD']=='DELETE'){
    $obtener = file_get_contents("php://input");  
    $_GET = json_decode($obtener, true);
        
    $delPqr = new ControllerPqr();
    $Result = $delPqr->deletePqrController();
    if($obtener ===''){
        $Message = array("Response"=>"Usuario No Eliminado.");
        echo json_encode($Message);
    }else{
        $Message = array(
            "Response"=>"PQR Eliminado.",
            "PQR"=>$Result
        );
        echo json_encode($Message);
    } 
}

?>