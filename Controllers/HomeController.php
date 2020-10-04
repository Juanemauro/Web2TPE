<?php 
include_once './Views/HomeView.php';

class HomeController{
    // DECLARACIÓN DE ATRIBUTOS
    private $view;
    // CONSTRUCTOR
    function __construct(){
        $this->view = new HomeView();
    }
    // SHOW HOME
    function showHome(){
        $this->view->showHomeView();
    }
    // SHOW FAQS
    function showFaq(){
        $this->view->showFaq();
    }
}
?>