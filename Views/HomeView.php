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
    // Muestra un mensaje de error al usuario cuando no completó todos los campos del formulario
    function showError($mensajeError, $redireccion, $seccion, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Error!");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('mensajeError', $mensajeError);
        $this->smarty->assign('seccion', $seccion);
        $this->smarty->assign('redireccion', $redireccion);
        $this->smarty->display('templates/Acceso/errorForm.tpl');
    }
 }
?>