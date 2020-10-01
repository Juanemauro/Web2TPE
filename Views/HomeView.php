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
    function showHomeView(){
        $this->smarty->assign('titulo',"Home");
        $this->smarty->display('templates/Home.tpl');
    }
    function showFaq(){
        $this->smarty->assign('titulo', "FAQ");
        $this->smarty->display('templates/faq.tpl');
    }
 }
?>