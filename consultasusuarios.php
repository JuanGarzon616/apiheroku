<?php
header('Content-Type: application/json');
require("conexion.php");

class ConsultasUsuario extends ConexionDb{
    private $conexion;
    public function __construct( ){
        $this->conexion = ConexionDb::Conex();
    }
    public function insertNewUser($DatoUser, $Table){
        $stmt = ConexionDb::Conex()->prepare("INSERT INTO usuario (num_usuario, nombre_usuario, segnom_usuario, primer_apellido, segundo_apellido, direccion_usuario, 
        telefono_usuario, segtelefono_usuario, correo_usuario, contraseña_usuario, img_usuario, fk_rolid_rol, fk_tipodocumentoid_documento)
        VALUES (:id,:nam1,:nam2,:nam3,:nam4,:dir,:tel1,:tel2,:mail,:pass,:img,:rol,:tipid)");
        $stmt->bindParam(':id',    $DatoUser->id,    PDO::PARAM_STR);
        $stmt->bindParam(':nam1',  $DatoUser->nam1,  PDO::PARAM_STR);
        $stmt->bindParam(':nam2',  $DatoUser->nam2,  PDO::PARAM_STR);
        $stmt->bindParam(':nam3',  $DatoUser->nam3,  PDO::PARAM_STR);
        $stmt->bindParam(':nam4',  $DatoUser->nam4,  PDO::PARAM_STR);
        $stmt->bindParam(':dir',   $DatoUser->dir,   PDO::PARAM_STR);
        $stmt->bindParam(':tel1',  $DatoUser->tel1,  PDO::PARAM_STR);
        $stmt->bindParam(':tel2',  $DatoUser->tel2,  PDO::PARAM_STR);
        $stmt->bindParam(':mail',  $DatoUser->mail,  PDO::PARAM_STR);
        $stmt->bindParam(':pass',  $DatoUser->pass,  PDO::PARAM_STR);
        $stmt->bindParam(':img',   $DatoUser->img,   PDO::PARAM_STR);
        $stmt->bindParam(':rol',   $DatoUser->rol,   PDO::PARAM_INT);
        $stmt->bindParam(':tipid', $DatoUser->tipId, PDO::PARAM_INT);
        var_dump($DatoUser);
        if($stmt->execute()){
            $consulta = array("query"=>false);
            return $consulta;
        }
        else{
            $consulta = array("query"=>false);
            return $consulta;
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    public function readUsuarioModel($id, $tidoc, $Table){
        $stmt = ConexionDb::Conex()->prepare("SELECT num_usuario, nombre_usuario, segnom_usuario, primer_apellido, segundo_apellido, 
        telefono_usuario,correo_usuario, contraseña_usuario, fk_rolid_rol, fk_tipodocumentoid_documento FROM $Table where num_usuario = :id AND fk_tipodocumentoid_documento = :tipDoc");
        $stmt->bindParam(':id',     $id,    PDO::PARAM_STR);
        $stmt->bindParam(':tipDoc', $tidoc, PDO::PARAM_STR);
            if($stmt->execute()){
            $stmt->bindColumn("num_usuario", $num_usuario);
            $stmt->bindColumn("nombre_usuario", $nombre_usuario);
            $stmt->bindColumn("segnom_usuario", $segnom_usuario);
            $stmt->bindColumn("primer_apellido", $primer_apellido);
            $stmt->bindColumn("segundo_apellido", $segundo_apellido);
            $stmt->bindColumn("telefono_usuario", $telefono_usuario);
            $stmt->bindColumn("correo_usuario", $correo_usuario);
            $stmt->bindColumn("contraseña_usuario", $contraseña_usuario);
            $stmt->bindColumn("fk_rolid_rol", $rol);
            $stmt->bindColumn("fk_tipodocumentoid_documento", $id_tip);
            $usuarios = array();

            while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
                
                $user = array();
                
                $user["num_usuario"] = utf8_encode($num_usuario);
                $user["nombre_usuario"] = utf8_encode($nombre_usuario);
                $user["segnom_usuario"] = utf8_encode($segnom_usuario);
                $user["primer_apellido"] = utf8_encode($primer_apellido);
                $user["segundo_apellido"] = utf8_encode($segundo_apellido);
                $user["telefono_usuario"] = utf8_encode($telefono_usuario);
                $user["correo_usuario"] = utf8_encode($correo_usuario);
                $user["contraseña_usuario"] = utf8_encode($contraseña_usuario);
                $user["fk_rolid_rol"] = utf8_encode($rol);
                $user["fk_tipodocumentoid_documento"] = utf8_encode($id_tip);

                array_push($usuarios, $user);
            }
            return $usuarios;
        }
        else{
            $consulta = array("query"=>false);
            return $consulta;
        }

    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    
    public function updateUsuarioModel($datosModel, $table){
        $stmt =  ConexionDb::Conex()->prepare("UPDATE $table set contraseña_usuario = :pass WHERE num_usuario = :id");

        $stmt->bindParam(":pass", $datosModel["contraseña_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datosModel["num_usuario"], PDO::PARAM_INT);
        if($stmt->execute()){
            $consulta = array("query"=>true);
            return $consulta;
        }else{
            $consulta = array("query"=>false);
            return $consulta;
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    public function deleteUser($id, $tipdoc, $table) {
        $stmt = ConexionDb::Conex()->prepare("DELETE  FROM $table WHERE num_usuario = :id AND fk_tipodocumentoid_documento = :tidoc");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':tidoc', $tipdoc, PDO::PARAM_INT);
        if($stmt->execute()){
            $consulta = array("query"=>true);
            return $consulta;
        }
        else{
            $consulta = array("query"=>false);
            return $consulta;
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    
    public function loginUsuarioModel($mail, $pass, $table){
        $stmt1 = ConexionDb::Conex()->prepare("SELECT contraseña_usuario FROM $table WHERE correo_usuario = :mail");
        $stmt1->bindParam(":mail", $mail, PDO::PARAM_STR);
        $stmt1->execute();
        $dbPass = $stmt1->fetchColumn();
        if(password_verify($pass, $dbPass)==true){
            $stmt = ConexionDb::Conex()->prepare("SELECT num_usuario, nombre_usuario, segnom_usuario, primer_apellido, segundo_apellido, direccion_usuario, 
            telefono_usuario, segtelefono_usuario, correo_usuario, contraseña_usuario, img_usuario, fk_rolid_rol, fk_tipodocumentoid_documento FROM $table WHERE correo_usuario = :mail");
        
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);

            $stmt->execute();

            $stmt->bindColumn('num_usuario', $num_usuario);
            $stmt->bindColumn('nombre_usuario',  $nombre_usuario);
            $stmt->bindColumn('segnom_usuario',  $segnom_usuario);
            $stmt->bindColumn('primer_apellido',  $primer_apellido);
            $stmt->bindColumn('segundo_apellido',  $segundo_apellido);
            $stmt->bindColumn('direccion_usuario',  $direccion_usuario);
            $stmt->bindColumn('telefono_usuario',  $telefono_usuario);
            $stmt->bindColumn('segtelefono_usuario',  $segtelefono_usuario);
            $stmt->bindColumn('correo_usuario',  $correo_usuario);
            $stmt->bindColumn('contraseña_usuario',  $contraseña_usuario);
            $stmt->bindColumn('img_usuario',  $img_usuario);
            $stmt->bindColumn('fk_rolid_rol',  $fk_rolid_rol);
            $stmt->bindColumn('fk_tipodocumentoid_documento',  $fk_tipodocumentoid_documento);

            while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){

                $user = array();

                $user["num_usuario"] = utf8_encode($num_usuario);
                $user["nombre_usuario"] = utf8_encode($nombre_usuario);
                $user["segnom_usuario"] = utf8_encode($segnom_usuario);
                $user["primer_apellido"] = utf8_encode($primer_apellido);
                $user["segundo_apellido"] = utf8_encode($segundo_apellido);
                $user["telefono_usuario"] = utf8_encode($telefono_usuario);
                $user["correo_usuario"] = utf8_encode($correo_usuario);
                $user["contraseña_usuario"] = utf8_encode($contraseña_usuario);
                $user["img_usuario"] = utf8_encode($img_usuario);
                $user["fk_rolid_rol"] = utf8_encode($fk_rolid_rol);
                $user["fk_tipodocumentoid_documento"] = utf8_encode($fk_tipodocumentoid_documento);

            }
            if(!empty($user)){
                return $user;
            }else{
                $consulta = array("query"=>false);
                return $consulta;
            }   
        }
        else {
            $consulta = array("query"=>false);
            return $consulta;
        }
    }

}
echo "hola";

?>