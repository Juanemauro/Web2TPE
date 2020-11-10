<?php
include_once './Models/UsersModel.php';
include_once './Views/UsersView.php';
require_once './Controllers/AutenticacionController.php';

class UsersController {
    // DECLARACIÓN DE ATRIBUTOS
    private $usersModel;
    private $usersView;
    private $homeView;
    private $loggeado;
    private $admin;
    private $autenticacion;

    // CONSTRUCTOR
    function __construct(){        
        $this->usersModel = new UsersModel();
        $this->usersView = new UsersView();
        $this->homeView = new HomeView();
        $this->autenticacion = new AutenticacionController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    }
      
    // VERIFICA USUARIO Y CONTRASEÑA
    function verificarUser(){
        $user = $_POST["alias"];
        $pass = $_POST["password"];
        if (!empty($user) && !empty($pass)){
            if(isset($user)){
                $usuarioLoggeado = $this->usersModel->getUser($user);
                if(isset($usuarioLoggeado) && $usuarioLoggeado){
                    // Existe el usuario
                    if (password_verify($pass, $usuarioLoggeado->password)){
                        $this->autenticacion->login($usuarioLoggeado);
                        header("Location: ". HOME);                    
                    }else{
                        $loggeado = false;
                        $this->usersView->ShowLogin("Contraseña incorrecta", $loggeado, $this->admin);
                    }
                }else{
                    // No existe el user en la DB
                    $loggeado = false;
                    $this->usersView->ShowLogin("Usuario incorrecto", $loggeado, $this->admin);
                }
            }      
        }else{ 
            $loggeado = false;
            $this->usersView->ShowLogin("Faltan campos obligatorios.", $loggeado, $this->admin);
        }        
    }
  
    // REGISTRA USUARIO
    function registrarUsuario(){
            $alias = $_POST['username'];
            $passForm = $_POST['password'];
            $pregunta = $_POST['pregunta'];
            $respuesta = $_POST['respuesta'];
            if (!empty($alias) && !empty($passForm) && !empty($pregunta) && !empty($respuesta)){
                $password = password_hash($passForm, PASSWORD_DEFAULT);
                $this->usersModel->registrarUsuario($alias, $password, $pregunta, $respuesta);
                $usuario = $this->usersModel->getUser($alias);
                $this->autenticacion->login($usuario);
                header("Location: " . HOME);
            }else{
                $loggeado = false;
                $this->usersView->showRegistro("Faltan campos obligatorios.", $loggeado, $this->admin);
            }                     
    }

    // MUESTRA FORM PARA INDICAR EL USUARIO PARA RECUPERAR LA CONTRASEÑA
    function selectUser(){
        if ($this->loggeado){
            header("Location: " . HOME);
        }else{
            $error = '';
            $this->usersView->showSelectUser($error, $this->loggeado, $this->admin);
        }        
    }

    // Verificar que existe el usuario para actualizar la contraseña
    function verificarUsuario(){
        $usuario = $_POST['username'];
        if ($this->loggeado){
            header("Location: " . HOME);
        }else{
            if (!empty($usuario)){
                $existe = $this->usersModel->getUser($usuario);
                if (!$existe){
                    $error = 'El usuario no existe, por favor ingréselo nuevamente.';
                    $this->usersView->showSelectUser($error, $this->loggeado, $this->admin);
                }else{                    
                    $aviso = '';
                    $this->usersView->showPreguntasForm($aviso, $this->loggeado, $usuario, $this->admin);
                }
            }else{
                $error = 'Falta ingresar el alias de usuario.';
                $this->usersView->showSelectUser($error, $this->loggeado, $this->admin);
            }
        }   
    }

    // Verificar que la pregunta y la respuesta sean correctas para poder realizar el cambio de contraseña
    function verificarPregunta(){
        $pregunta = $_POST['pregunta'];
        $respuesta = $_POST['respuesta'];
        $usuario = $_POST['usuario'];
        if ($this->loggeado){
            header("Location: " . HOME);
        }else{
            if (!empty($pregunta) && (!empty($respuesta))){
                $user = $this->usersModel->getUser($usuario);
                if (($pregunta == $user->pregunta) && ($respuesta == $user->respuesta)){
                    $error = '';
                    $this->usersView->showNewPasswordForm($error, $this->loggeado, $user->alias, $this->admin);
                }else{
                    $aviso = 'Los datos no son correctos, por favor ingréselos nuevamente.';
                    $this->usersView->showPreguntasForm($aviso, $this->loggeado, $usuario, $this->admin);
                }
            }else{
                $aviso = 'Faltan campos obligatorios.';
                $this->usersView->showPreguntasForm($aviso, $this->loggeado, $usuario, $this->admin);
            }
        }
    }

    // Actualizar la contraseña
    function updatePassword(){
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $usuario = $_POST['usuario'];
        $user = $this->usersModel->getUser($usuario);
        if ($this->loggeado){
            header("Location: " . HOME);
        }else{
            if (!empty($password1) && (!empty($password2))){               
                if ($password1 !== $password2){
                    $error = 'Las contraseñas no son iguales, por favor ingréselas nuevamente.';
                    $this->usersView->showNewPasswordForm($error, $this->loggeado, $user->alias, $this->admin);
                }else{                 
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $this->usersModel->updatePassword($password, $user->id_usuario);
                    header("Location: " . HOME);
                }
            }else{
                $error = 'Faltan campos obligatorios.';
                $this->usersView->showNewPasswordForm($error, $this->loggeado, $user->alias, $this->admin);
            }
        }
    }  

    // Otorga permisos de admin a un usuario que no lo es
    function hacerAdmin($params = null){
        $id = $params[':ID'];
        if ($this->admin){
            $existe = $this->usersModel->getUserById($id);
            if ($existe){
                $permiso = 1;
                $this->usersModel->updatePermiso($permiso, $id);
                $usuarios = $this->usersModel->getUsuarios();
                $usuario = $_SESSION["ALIAS"];
                $this->homeView->showMenuAdmin($this->loggeado, $usuarios, $usuario, $this->admin);
            }else{
                $seccion = "al Menú Administrador";
                $this->homeView->showError("No existe el usuario con ese ID.", "showMenuAdmin", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . HOME);
        }        
    }

    // Elimina el permiso de admin de un usuario
    function sacarPermiso($params = null){
        $id = $params[':ID'];
        if ($this->admin){
            $existe = $this->usersModel->getUserById($id);
            if ($existe){
                $permiso = 0;
                $this->usersModel->updatePermiso($permiso, $id);
                $usuarios = $this->usersModel->getUsuarios();
                $usuario = $_SESSION["ALIAS"];
                $this->homeView->showMenuAdmin($this->loggeado, $usuarios, $usuario, $this->admin);
            }else{
                $seccion = "al Menú Administrador";
                $this->homeView->showError("No existe el usuario con ese ID.", "showMenuAdmin", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . HOME);
        }   
    }

    // Eliminar usuario
    function deleteUsuario($params = null){
        $id = $params[':ID'];
        if ($this->admin){
            $existe = $this->usersModel->getUserById($id);
            if ($existe){
                $this->usersModel->deleteUsuario($id);
                $usuarios = $this->usersModel->getUsuarios();
                $usuario = $_SESSION["ALIAS"];
                $this->homeView->showMenuAdmin($this->loggeado, $usuarios, $usuario, $this->admin);
            }else{
                $seccion = "al Menú Administrador";
                $this->homeView->showError("No existe el usuario con ese ID.", "showMenuAdmin", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . HOME);
        }
    }
}