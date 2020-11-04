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

    function getUserById($user){
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario.id_usuario=?");
        $sentencia->execute(array($user));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    function getUsuarios(){
        $sentencia = $this->db->prepare("SELECT * FROM usuario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Agrega un usuario a la BDD
    function registrarUsuario($alias, $password, $pregunta, $respuesta) {
        $sentencia = $this->db->prepare('INSERT INTO usuario(alias, password, pregunta, respuesta) VALUES(?,?,?,?)');
        $sentencia->execute(array($alias, $password, $pregunta, $respuesta));
    }

    function updatePassword($password1, $id){
        $sentencia = $this->db->prepare('UPDATE usuario SET password=? WHERE id_usuario = ?');
        $sentencia->execute(array($password1, $id));
    }

    function updatePermiso($permiso, $id){
        $sentencia = $this->db->prepare('UPDATE usuario SET admin=? WHERE id_usuario = ?');
        $sentencia->execute(array($permiso, $id));
    }

    function deleteUsuario($id){
        $sentencia = $this->db->prepare('DELETE FROM usuario WHERE usuario.id_usuario = ?' );
        $sentencia->execute(array($id));
    }
}
?>