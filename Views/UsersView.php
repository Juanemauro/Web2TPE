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
    function showLogin($aviso = ""){
        $this->smarty->assign('titulo', "Login");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->display('templates/login.tpl');
    }
    // Muestra form para registrarse
    function showRegistro(){
        $this->smarty->assign('titulo', "Registro");
        $this->smarty->display('templates/registro.tpl');
    }
}
?>