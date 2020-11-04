<?php 

class AutenticacionController {
    function __construct() {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }   
    }

     // VERIFICA QUE SE HAYA INICIADO UNA SESIÓN

    function login($usuarioLoggeado){
        session_start();
        $_SESSION["ALIAS"] = $usuarioLoggeado->alias;
        $_SESSION['ADMINISTRADOR'] = $usuarioLoggeado->admin;
    } 
    function checkLoggedIn(){
            //session_start();
            if (!isset($_SESSION['ALIAS'])) {
                return false;
            }else{
                return true;
            }
    } 

    function checkAdmin(){
        if (isset($_SESSION['ALIAS'])) {
            if ($_SESSION['ADMINISTRADOR'] == 1)
                return true;
            else{
                return false;
            }
        }
    }

    // CIERRA SESIÓN
    function logout(){
        session_start();        
        session_destroy();
        header("Location: ". LOGIN);
    }

}
?>

