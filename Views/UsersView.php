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
    function showLogin($aviso = "", $loggeado, $admin){
        $this->smarty->assign('titulo', "Login");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Acceso/login.tpl');
    }
    // Muestra form para registrarse
    function showRegistro($aviso = "", $loggeado, $admin){
        $this->smarty->assign('titulo', "Registro");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Acceso/registro.tpl');
    }

    function showSelectUser($error, $loggeado, $admin){
        $this->smarty->assign('titulo', "Recuperar contraseña");
        $this->smarty->assign('error', $error);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Acceso/usuarioRecuperar.tpl');
    }

    function showPreguntasForm($aviso, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Preguntas secretas del usuario");
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Acceso/Preguntas.tpl');
    }

    function showNewPasswordForm($error, $loggeado, $alias, $admin){
        $this->smarty->assign('titulo', "Actualizar contraseña");
        $this->smarty->assign('error', $error);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('alias', $alias);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Acceso/newPassword.tpl');
    }
}
?>