<?php
//error_reporting(0);
class ConexionDb{
    public function Conex(){
        try{
            $localhost = "bgxg5qc2axrntuq5skf0-mysql.services.clever-cloud.com";
            $user      = "uo8gozkphyogah1q";
            $database  = "bgxg5qc2axrntuq5skf0";
            $password  = "XKetDeqslic21JSvJaSC";

            $link = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            $e -> getMessage();
            die();
        }

        return $link;
    }
}
//$obj = new Conexiondb();
//$obj->Conex();

/*
class UsuarioDaoImp extends Conexiondb{
    private $conexion;
    public function __construct( ){
        $this->conexion = Conexiondb::Conex();
    }
    public function getListaUsuarios(){
        $stmt = $this->conexion->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$modelo = new UsuarioDaoImp();
$resultado = $modelo->getListaUsuarios();
if($resultado){
    foreach($resultado as $row=>$item){
        echo $item["nombre_usuario"]."<br>";
    }
}*/

?>