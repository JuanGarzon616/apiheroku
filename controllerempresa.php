<?php

require_once 'consultaempresa.php';
/**
 * 
 */
class ControllerEmpresa{
    public function createEmpresaController(){
        $respuesta1 = ConsultasEmpresa::createEmpresaModel($this, "empresas");
        return $respuesta1;
    }
}

public function readEmpresaController(){
    $respuesta = Datos::readEmpresaModel("empresas");
    return $respuesta;
}

public function updateEmpresaController($id_empresa, $contraseña_empresa){
    $datosController = array("id_empresa"=>$id_empresa, "contraseña_empresa"=>$contraseña_empresa);
    $respuesta = Datos::updateEmpresaModel($datosController, "empresas");
    return $respuesta;
}

public function deleteEmpresaController($id_empresa){
    $respuesta = Datos::deleteEmpresaModel($id_empresa, "empresas");
    return $respuesta;
}

public function loginEmpresaController($nom_empresa, $contraseña_empresa){
    $datosController = array("nom_empresa" => $nom_empresa, "contraseña_empresa" => $contraseña_empresa);

    $respuesta = Datos::loginEmpresaModel($datosController, "empresas");
    return $respuesta;
}

?>