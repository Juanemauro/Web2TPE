<?php 
include_once './Views/HomeView.php';

class HomeController{
    // DECLARACIÓN DE ATRIBUTOS
    private $view;
    private $user;
    private $usersView;
    // CONSTRUCTOR
    function __construct(){
        $this->view = new HomeView();
        $this->user = new UsersController();
        $this->usersView = new UsersView();
    }
    // SHOW HOME
    function showHome(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showHomeView($loggeado, $usuario);
    }
    // SHOW FAQS
    function showFaq(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showFaq($loggeado, $usuario);
    }

    // MUESTRA EL FORM PARA LOGGEARSE
    function loginForm(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado){
            header("Location: ". HOME);
        }else{
            $usuario = "";
            $this->usersView->showLogin($loggeado, $usuario); 
        }        
    }

    // MUESTRA FORM PARA REGISTRARSE
    function registroForm(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado){
            header("Location: ". HOME);
        }else{
            $usuario = "";
            $this->usersView->showRegistro($loggeado, $usuario); 
        }                
    }
}
?>