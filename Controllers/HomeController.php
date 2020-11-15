<?php 
require_once './Views/HomeView.php';
require_once './Controllers/AutenticacionController.php';
require_once './Models/UsersModel.php';

class HomeController{
    // DECLARACIÓN DE ATRIBUTOS
    private $view;
    private $user;
    private $usersView;
    private $loggeado;
    private $admin;
    private $autenticacion;
    private $usesrModel;
    // CONSTRUCTOR
    function __construct(){
        $this->view = new HomeView();
        $this->user = new UsersController();
        $this->usersView = new UsersView();
        $this->autenticacion = new AutenticacionController();
        $this->usersModel = new UsersModel();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    }
    // SHOW HOME
    function showHome(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showHomeView($this->loggeado, $usuario, $this->admin);
    }
    // SHOW FAQS
    function showFaq(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->view->showFaq($this->loggeado, $usuario, $this->admin);
    }

    // MENÚ ADMIN
    function showMenuAdmin(){
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        }
        $usuarios = $this->usersModel->getUsuarios($usuario);
        //var_dump($usuarios);
        //die();
        if (!empty($usuarios)){
            $this->view->showMenuAdmin($this->loggeado, $usuarios, $usuario, $this->admin);
        }else{
            $seccion = "a Home";
            $this->view->showError("No existen otros usuarios, deberías promocionar la página..", "showHome", $seccion, $this->loggeado, $usuario, $this->admin);
        }
            
        
    }
    // MUESTRA EL FORM PARA LOGGEARSE
    function loginForm(){
        if ($this->loggeado){
            header("Location: ". HOME);
        }else{
            $usuario = "";
            $this->usersView->showLogin($this->loggeado, $usuario, $this->admin); 
        }        
    }

    // MUESTRA FORM PARA REGISTRARSE
    function registroForm(){
        if ($this->loggeado){
            header("Location: ". HOME);
        }else{
            $usuario = "";
            $this->usersView->showRegistro($this->loggeado, $usuario, $this->admin); 
        }                
    }
}
?>