<?php
include_once './Models/UsersModel.php';
include_once './Views/UsersView.php';
include_once './Views/UsersView.php';
class UsersController {
    // DECLARACIÓN DE ATRIBUTOS
    private $usersModel;
    private $usersView;
    private $homeView;

    // CONSTRUCTOR
    function __construct(){        
        //Controllers
        //Models
        $this->usersModel = new UsersModel();
        //Views
        $this->usersView = new UsersView();
        $this->homeView = new HomeView();
    }
    // MUESTRA FORMULARIO PARA LOGGEARSE
    
    // CIERRA SESIÓN
    function logout(){
        session_start();        
        session_destroy();
        header("Location: ". LOGIN);
    }
    // VERIFICA USUARIO Y CONTRASEÑA
    function verificarUser(){
        $user = $_POST["alias"];
        $pass = $_POST["password"];
        if (!empty($user) && !empty($pass)){
            if(isset($user)){
                $usuarioLoggeado = $this->usersModel->getUser($user);
                if(isset($usuarioLoggeado) && $usuarioLoggeado){
                    // Existe el usuario
                    if (password_verify($pass, $usuarioLoggeado->password)){
                        session_start();
                        $_SESSION["ALIAS"] = $usuarioLoggeado->alias;
                        header("Location: ". HOME);                    
                    }else{
                        $loggeado = false;
                        $this->usersView->ShowLogin("Contraseña incorrecta", $loggeado);
                    }
                }else{
                    // No existe el user en la DB
                    $loggeado = false;
                    $this->usersView->ShowLogin("Usuario incorrecto", $loggeado);
                }
            }      
        }else{ 
            $loggeado = false;
            $this->usersView->ShowLogin("Faltan campos obligatorios.", $loggeado);
        }        
    }
    // VERIFICA QUE SE HAYA INICIADO UNA SESIÓN
    function checkLoggedIn(){
        session_start();
            if (!isset($_SESSION['ALIAS'])) {
                return false;
            }else{
                return true;
            }
    }    
    // REGISTRA USUARIO
    function registrarUsuario(){
        //$loggeado = $this->checkLoggedIn();
        //if ($loggeado == true){
          //  header("Location: " . HOME);
        //}else{
            $alias = $_POST['username'];
            $passForm = $_POST['password'];
            if (!empty($alias) && !empty($passForm)){
                $password = password_hash($passForm, PASSWORD_DEFAULT);
                $this->usersModel->registrarUsuario($alias, $password);
                header("Location: " . HOME);
            }else{
                $loggeado = false;
                $this->usersView->showRegistro("Faltan campos obligatorios.", $loggeado);
            }   
        //}                     
    }
}