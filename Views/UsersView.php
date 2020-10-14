<?php
require_once "./libs/smarty/Smarty.class.php";
class UsersView{
    // DECLARACIÓN DE ATRIBUTOS
    private $smarty;
    // CONSTRUCTOR
    function __construct() {
        $this->smarty = new Smarty();
    }
    // Muestra form para loggearse
    function showLogin($aviso = "", $loggeado){
        $this->smarty->assign('titulo', "Login");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->display('templates/Acceso/login.tpl');
    }
    // Muestra form para registrarse
    function showRegistro($aviso = "", $loggeado){
        $this->smarty->assign('titulo', "Registro");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->display('templates/Acceso/registro.tpl');
    }
}
?>