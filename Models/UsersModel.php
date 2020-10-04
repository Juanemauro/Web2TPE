<?php
class UsersModel{
    // DECLARACIÓN DE ATRIBUTOS
    private $db;
    // CONSTRUCTOR
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', '');
    }
    // Obtiene datos de un usuario
    function getUser($user){
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE alias=?");
        $sentencia->execute(array($user));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // Agrega un usuario a la BDD
    function registrarUsuario($alias, $contraseña) {
        $sentencia = $this->db->prepare('INSERT INTO usuario(alias, password) VALUES(?,?)');
        $sentencia->execute(array($alias, $contraseña));
    }      
}
?>