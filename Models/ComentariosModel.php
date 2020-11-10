<?php
class ComentariosModel {
    private $db;
    // CONSTRUCTOR
    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_delivery;charset=utf8', 'root', '');
    }
    // Devuelve una tabla con los datos de todos los comentarios
    function getComentarios() {
        $sentencia = $this->db->prepare('SELECT * FROM comentario');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con los datos de un comentario x
    function getComentariosBypedido($id) {
        $sentencia = $this->db->prepare('SELECT * FROM comentario WHERE id_pedido = ?');
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Agrega un comentario a la BDD    
    function insertComentario($texto,$puntaje,$id_usuario, $id_pedido) {
        $sentencia = $this->db->prepare('INSERT INTO comentario(texto,puntaje,id_usuario,id_pedido) VALUES(?,?,?,?)');
        $sentencia->execute(array($texto,$puntaje,$id_usuario,$id_pedido));
        return $this->db->lastInsertId();
    }
    // Actualiza un comentario
    function updateComentario($id, $texto, $puntaje){
        $sentencia = $this->db->prepare('UPDATE comentario SET texto=?, puntaje=? WHERE id_comentario = ?');
        $sentencia->execute(array($texto, $puntaje, $id));
        return $sentencia->rowCount();
    }
    // Elimina un comentario de la BDD
    function borrarComentario($id) {
        $sentencia = $this->db->prepare('DELETE FROM comentario WHERE id_comentario = ?' );
        $sentencia->execute(array($id));
        return $sentencia->rowCount();
    }   

}
?>