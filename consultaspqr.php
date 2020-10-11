<?php

require("https://apiheroku321.herokuapp.com/conexion.php");

class ConsultasPqr extends ConexionDb{

    public function creatPqrModel($datosModel, $tabla){
        $stmt = ConexionDb::Conex()->prepare("INSERT INTO $tabla ( asunto_pqr, descripcion_prq, fk_tipo_pqrid_tipqr, fk_empresaid_empresa,
        fk_usuario_num_usuario, fk_empresanit_empresa, fk_usuariotipo_documentoid_documento)
        VALUES (:asunto_pqr, :descripcion_pqr, :tipqr, :fk_empresaid_empresa,
        :fk_usuario_num_usuario, :fk_empresanit_empresa, :fk_usuariotipo_documentopid_documento)");
        
        $stmt->bindParam(":asunto_pqr", $datosModel->asunto, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_pqr", $datosModel->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":tipqr", $datosModel->tipPqr, PDO::PARAM_INT);
        $stmt->bindParam(":fk_empresaid_empresa", $datosModel->idEmpresa, PDO::PARAM_INT);
        $stmt->bindParam(":fk_usuario_num_usuario", $datosModel->numUser, PDO::PARAM_INT);
        $stmt->bindParam(":fk_empresanit_empresa", $datosModel->nitEmpresa, PDO::PARAM_INT);
        $stmt->bindParam(":fk_usuariotipo_documentopid_documento", $datosModel->tipNumUser, PDO::PARAM_INT);

        if($stmt->execute() ) {
            $consulta = array("query"=>true);
            return $consulta;
        }else{
            $consulta = array("query"=>false);
            return $consulta;
        }
    }

    public function readPqrmodel($datosModel, $tabla){
        $stmt = ConexionDb::Conex()->prepare("SELECT Id_pqr, asunto_pqr, descripcion_prq, fecha_pqr, estado_pqr, fk_tipo_pqrid_tipqr, fk_empresaid_empresa,
        fk_usuario_num_usuario, fk_empresanit_empresa, fk_usuariotipo_documentoid_documento, respuesta_pqr FROM $tabla WHERE fk_usuario_num_usuario = :numUser AND fk_usuariotipo_documentoid_documento = :tipUser");
        $stmt->bindParam(":numUser", $datosModel['num'], PDO::PARAM_INT);
        $stmt->bindParam(":tipUser", $datosModel['tipdoc'], PDO::PARAM_INT);
        $stmt->execute();

        $stmt->bindColumn("Id_pqr", $Id_pqr);
        $stmt->bindColumn("asunto_pqr", $asunto_pqr);
        $stmt->bindColumn("descripcion_prq", $descripcion_pqr);
        $stmt->bindColumn("fecha_pqr", $fecha_pqr);
        $stmt->bindColumn("estado_pqr", $estado_pqr);
        $stmt->bindColumn("fk_tipo_pqrid_tipqr", $fk_tipo_pqrid_tipqr);
        $stmt->bindColumn("fk_empresaid_empresa", $fk_empresaid_empresa);
        $stmt->bindColumn("fk_usuario_num_usuario", $fk_usuario_num_usuario);
        $stmt->bindColumn("fk_empresanit_empresa", $fk_empresanit_empresa);
        $stmt->bindColumn("fk_usuariotipo_documentoid_documento", $fk_usuariotipo_documentopid_documento);
        $stmt->bindColumn("respuesta_pqr", $respuesta_pqr);
        $Pqrs = array();

        while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){

            $user = array();

            $user["Id_pqr"] = utf8_encode($Id_pqr);
            $user["asunto_pqr"] = utf8_encode($asunto_pqr);
            $user["descripcion_pqr"] = utf8_encode($descripcion_pqr);
            $user["fecha_pqr"] = utf8_encode($fecha_pqr);
            $user["estado_pqr"] = utf8_encode($estado_pqr);
            $user["fk_tipo_pqrid_tipqr"] = utf8_encode($fk_tipo_pqrid_tipqr);
            $user["fk_empresaid_empresa"] = utf8_encode($fk_empresaid_empresa);
            $user["fk_usuario_num_usuario"] = utf8_encode($fk_usuario_num_usuario);
            $user["fk_empresanit_empresa"] = utf8_encode($fk_empresanit_empresa);
            $user["fk_usuariotipo_documentopid_documento"] = utf8_encode($fk_usuariotipo_documentopid_documento);
            $user["respuesta_pqr"] = utf8_encode($respuesta_pqr);

            array_push ($Pqrs, $user);
        }

    return $Pqrs;
    }

    public Function updatePqrModel ($datosUpdate, $tabla){
        if(!empty($datosUpdate['estado'])){
            $stmt = ConexionDb::Conex()->prepare("UPDATE $tabla SET estado_pqr = :estado WHERE id_pqr = :Id_pqr");
            $stmt->bindParam (":estado", $datosUpdate["estado"], PDO::PARAM_STR);
            $stmt->bindParam (":Id_pqr", $datosUpdate["id_pqr"], PDO::PARAM_INT); 
            if($stmt->execute()){
                $consulta = array("query"=>true);
                return $consulta;
            }else{
                $consulta = array("query"=>false);
                return $consulta;
            }
        }
        
        if(!empty($datosUpdate['respuesta'])){
            $stmt = ConexionDb::Conex()->prepare("UPDATE pqr SET respuesta_pqr = ? WHERE id_pqr = ?");
            $stmt->bindParam (1, $datosUpdate["respuesta"], PDO::PARAM_STR);
            //$stmt->bindParam (2, $datosUpdate["estado"], PDO::PARAM_STR);
            $stmt->bindParam (2, $datosUpdate["id_pqr"], PDO::PARAM_STR); 
            if($stmt->execute()){
                $consulta = array("query"=>true);
                return $consulta;
            }else{
                $consulta = array("query"=>false);
                return $consulta;
            }
        }
    }

    public Function deletePqrModel ($id, $tabla){
        $stmt =  ConexionDb::Conex()->prepare("DELETE FROM $tabla WHERE Id_pqr = :Id_pqr");
        $stmt->bindParam (":Id_pqr", $id['idpqr'],  PDO::PARAM_INT);
        if($stmt->execute()){
            $consulta = array("query"=>true);
            return $consulta;
        }else{
            $consulta = array("query"=>false);
            return $consulta;
        }
    }
}




?>