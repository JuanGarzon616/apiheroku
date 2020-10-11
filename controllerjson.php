<?php
header('Content-Type: application/json');
require("consultasusuarios.php");

class ControllerUser{
    public $id;
    public $tipId;
    public $nam1;
    public $nam2;
    public $nam3;
    public $nam4;
    public $mail;
    public $dir;
    public $tel1;
    public $tel2;
    public $img;
    public $rol;
    public $pass;

    public function hashPass($pass){
        $PassHashed = password_hash($pass, PASSWORD_DEFAULT);
        return $PassHashed;
    }

    public function __construct(){
        if(!empty($_POST['identi'])){
            $this->id    = $_POST['identi'];
            $this->tipId = $_POST["tipodoc"];
            $this->nam1  = $_POST["nam1"];
            $this->nam2  = $_POST["nam2"];
            $this->nam3  = $_POST["nam3"];
            $this->nam4  = $_POST["nam4"];
            $this->mail  = $_POST["correo"];
            $this->dir   = $_POST["direcc"];
            $this->tel1  = $_POST["tele1"];
            $this->tel2  = $_POST["tele2"];
            $this->img   = "../vista/asset/ImgUsers/default.jpg";
            $this->rol   = 2;
            $this->pass  = $this->hashPass($_POST["pass1"]);            
        }
            //var_dump($_POST);
    }    
    
    public function createUserController(){
        $respuesta1 = ConsultasUsuario::insertNewUser($this, "usuario");
        return $respuesta1;
    }

    public function readUsuariosController(){
        $id    = $_GET['id'];
        $tidoc = $_GET['tiPod'];
        $respuesta2 = ConsultasUsuario::readUsuarioModel($id, $tidoc, "usuario");
        return $respuesta2;
    }

    public function updateUserController(){
        $datosController = array("num_usuario" => $_GET['id'], "contraseña_usuario"=> $this->hashPass($_GET["pass"]));
        //var_dump($_GET);
        $respuesta3 = ConsultasUsuario::updateUsuarioModel($datosController, "usuario");
        return $respuesta3;
    }

    public function deleteUsuarioController(){
        $respuesta4 = ConsultasUsuario::deleteUser($_GET['id'], $_GET['tipodoc'], "usuario");
        return $respuesta4;
    }

    public function loginUsuarioController(){
        $mail = $_GET['mail'];
        $pasw = $_GET['pass'];
        //$datosController = array("correo_usuario" => $_GET['mail'], "pss"=>$_GET['pass']);
        $respuesta5 = ConsultasUsuario::loginUsuarioModel($mail, $pasw, "usuario");
        return $respuesta5;
    }
}

?>