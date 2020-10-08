<?php 
include_once './Views/HomeView.php';

class HomeController{
    // DECLARACIÓN DE ATRIBUTOS
    private $view;
    private $user;
    // CONSTRUCTOR
    function __construct(){
        $this->view = new HomeView();
        $this->user = new UsersController();
    }
    // SHOW HOME
    function showHome(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showHomeView($loggeado, $usuario);
    }
    // SHOW FAQS
    function showFaq(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showFaq($loggeado, $usuario);
    }
}
?>