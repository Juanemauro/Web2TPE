<?php
require_once "./libs/smarty/Smarty.class.php";
class HomeView {
    // DECLARACIÓN DE ATRIBUTOS
        private $smarty;
    // CONSTRUCTOR
    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->assign('basehref', BASE_URL);
    }
    // MOSTRAR HOME
    function showHomeView($loggeado, $usuario){
        $this->smarty->assign('titulo',"Home");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Acceso/Home.tpl');
    }
    // MOSTRAR FAQ
    function showFaq($loggeado, $usuario){
        $this->smarty->assign('titulo', "FAQ");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Acceso/faq.tpl');
    }
 }
?>