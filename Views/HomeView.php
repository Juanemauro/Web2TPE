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
    function showHomeView($loggeado, $usuario, $admin){
        $this->smarty->assign('titulo',"Home");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Acceso/Home.tpl');
    }
    // MOSTRAR FAQ
    function showFaq($loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "FAQ");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Acceso/faq.tpl');
    }
    // Muestra un mensaje de error al usuario cuando no completó todos los campos del formulario o accedo a algún lugar con tablas vacías, etc
    function showError($mensajeError, $redireccion, $seccion, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Error!");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('mensajeError', $mensajeError);
        $this->smarty->assign('seccion', $seccion);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('redireccion', $redireccion);
        $this->smarty->display('templates/Acceso/error.tpl');
    }

    function showErrorImagen($mensajeError, $errorImagenes, $redireccion1, $redireccion2, $seccion1, $seccion2, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Error!");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('mensajeError', $mensajeError);
        $this->smarty->assign('seccion1', $seccion1);
        $this->smarty->assign('seccion2', $seccion2);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('errorImagenes', $errorImagenes);
        $this->smarty->assign('redireccion1', $redireccion1);
        $this->smarty->assign('redireccion2', $redireccion2);
        $this->smarty->display('templates/Acceso/errorImagenes.tpl');
    }


    // Muestra el menú para el ABM de usuario
    function showMenuAdmin($loggeado, $usuarios, $usuario, $admin){
        $this->smarty->assign('titulo', "Menú Admin");
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('usuarios', $usuarios);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->display('templates/Acceso/menuAdmin.tpl');
    }
 }
?>