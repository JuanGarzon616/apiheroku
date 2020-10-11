<?php
require_once 'conexion.php';
class consultaempresa extends ConexionDb
{
Public function createEmpresaModel($datosModel, $tabla){
    $stmt =  ConexionDb::Conex()->prepare("INSERT INTO $tabla(id_empresa,nit_empresa,tel_empresa,tel_empresa2,nom_empresa,
    correo_empresa,contraseña_empresa,fk_rolid_rol,fk_empresa_rol) VALUES (:id_empresa,:nit_empresa,
    :tel_empresa,:tel_empresa2,:nom_empresa, :correo_empresa,:contraseña_empresa,:foto,:fk_rolid_rol,:fk_empresa_rol)");



    $stmt->bindParam(":id_empresa", $datosModel["id_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":nit_empresa", $datosModel["nit_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":tel_empresa", $datosModel["tel_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":tel_empresa2", $datosModel["tel_empresa2"], PDO ::PARAM_STR);
    $stmt->bindParam(":nom_empresa", $datosModel["nom_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":correo_empresa", $datosModel["correo_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":contraseña_empresa", $datosModel["contraseña_empresa"], PDO ::PARAM_STR);
    $stmt->bindParam(":fk_rolid_rol", $datosModel["fk_rolid_rol"], PDO ::PARAM_STR);
    $stmt->bindParam(":fk_empresa_rol", $datosModel["fk_empresa_rol"], PDO ::PARAM_STR);

    if ($stmt->execute(){
        return true;
    }else{
        return false;
    
    }
}
 public function readEmpresaModel($datos, $tabla){
    $stmt->bindParam(":correo_empresa", $datosModel["correo_empresa"], PDO ::PARAM_STR);
    $stmt =  ConexionDb::Conex()->prepare("SELECT id_empresa,nit_empresa,tel_empresa,nom_empresa,contraseña_empresa,
    fk_rolid_rol,fk_empresa_rol FROM $tabla where nit_empresa = ?");
    $stmt->bindParam(1, $datos['nit'], PDO::PARAM_STR);
    $stmt->execute()

    $stmt->bindcolumn("id_empresa",$id_empresa);
    $stmt->bindcolumn("nit_empresa",$nit_empresa);
    $stmt->bindcolumn("tel_empresa",$tel_empresa);
    $stmt->bindcolumn("nom_empresa",$nom_empresa);
    $stmt->bindcolumn("contraseña_empresa",$contraseña_empresa);
    $stmt->bindcolumn("fk_rolid_rol",$fk_rolid_rol);
    $stmt->bindcolumn("fk_empresa_rol",$fk_empresa_rol);
    $usuarios = array ();

    while ($fila= $stmt->fetch(PDO::FETCH_BOUND )){
        $user = array();

        $user["id_empresa"] =utf8_encode ($id_empresa);
        $user["nit_empresa"] =utf8_encode ($nit_empresa);
        $user["tel_empresa"] =utf8_encode ($tel_empresa);
        $user["nom_empresa"] =utf8_encode ($nom_empresa);
        $user["contraseña_empresa"] =utf8_encode ($contraseña_empresa);
        $user["fk_rolid_rol"] =utf8_encode ($fk_rolid_rol);
        $user["fk_empresa_rol"] =utf8_encode ($fk_empresa_rol);
        array_push($usuarios, $user);
    }
        return $usuarios;
    }

    public function updateEmpresaModel($datosModel, $tabla){
        $stmt =  ConexionDb::Conex()->prepare("UPDATE $tabla set contraseña_empresa =
        :contraseña_empresa WHERE id_empresa = :id_empresa");

        $stmt->bindParam(":contraseña_empresa",$datosModel["contraseña_empresa"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa",$datosModel["id_empresa"] PDO::PARAM_INT);
        if ($stmt->execute()){
            echo"Actualizacion Existosa";
        }else{
            echo "No se pudo hacer la Actualizacion ";

        }
    }

    public function deleteEmpresaModel($id_empresa, $tabla){
        $stmt =  ConexionDb::Conex()->prepare("DELETE FROM $tabla WHERE id_empresa = ?";
        $stmt->bindParam(1, $id_empresa, PDO::PARAM_INT);
        $stmt->execute()){
            echo "Usuario eliminado correctamente";
        }else{
            echo "El Usuario no se pudo eliminar";
        }
    }

    public function loginEmpresaModel($datosModel, $tabla){
        $stmt =  ConexionDb::Conex()->prepare("SELECT  FROM $tabla WHERE nom_empresa = :nom_empresa AND
        contraseña_empresa = :contraseña_empresa");
         
         $stmt->bindParam("nom_empresa",$datosModel["username"]);
         $stmt->bindParam("contraseña_empresa",$datosModel["contraseña_empresa"]);

         $stmt->execute();

         $stmt->bindcolumn("id_empresa", $id_empresa);
         $stmt->bindcolumn("nom_empresa", $nom_empresa);
         $stmt->bindcolumn("contraseña_empresa", $contraseña_empresa);

         While ($fila=$stmt->fetch(PDO::FETCH_BOUND)){
            $user= array();
            $user["id_empresa"]=utf8_encode($id_empresa);
            $user["nom_empresa"]=utf8_encode($nom_empresa);
            $user["contraseña_empresa"]=utf8_encode($contraseña_empresa);
         }
         if (!empty($user){
             return $user;
         }else{
             return false;
         }
     }
}
?> 

       
  