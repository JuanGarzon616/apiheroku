<?php
//error_reporting(0);
header('Content-Type: application/json');
require('consultaspqr.php');

class ControllerPqr{
    public $asunto;
    public $descripcion;
    public $tipPqr;
    public $idEmpresa;
    public $numUser;
    public $tipNumUser;
    public $nitEmpresa;

    public function __construct(){
        if(!empty($_POST['asunto'])){
            $this->asunto      = $_POST['asunto'];
            $this->descripcion = $_POST['descripcion'];
            $this->tipPqr      = $_POST['tipqr'];
            $this->idEmpresa   = $_POST['idempresa'];
            $this->numUser     = $_POST['numuser'];
            $this->tipNumUser  = $_POST['tipdoc'];
            $this->nitEmpresa  = $_POST['nitempresa'];
        }
    }


    public function createPqrController(){
        $respuesta1 = ConsultasPqr::creatPqrModel($this, "pqr");
        return $respuesta1;
    }


    public function readPqrController(){
        $datos = array("num" => $_GET['numuser'], "tipdoc" => $_GET['tipdoc']);
        $respuesta = ConsultasPqr::readPqrModel($datos,"pqr");
        return $respuesta;
    }

    public function updatePqrController(){
        $datosController = array("id_pqr" => $_GET['idpqr'], "estado" => $_GET['estado'], "respuesta" => $_GET['respuestacion']);
        $respuesta = ConsultasPqr::updatePqrModel($datosController, "pqr");
        return $respuesta;
    }

    public function deletePqrController(){
        $datosController = array("idpqr" => $_GET['idpqr']);
        $respuesta = ConsultasPqr::deletePqrModel($datosController, "pqr");
        return $respuesta;
    }

}
echo "hola";
?>