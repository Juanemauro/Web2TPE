<?php
    class ImagenesModel{
        private $db;
        // CONSTRUCTOR
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', ''); 
        }

        // OBTENER IMÁGENES SEGÚN ID_PEDIDO
        function getImagenesPorPedido($id_pedido){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_pedido = ?');         
            $sentencia->execute(array($id_pedido));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        // INSERTAR IMÁGENES
        function addImages($id_pedido, $rutaImagen, $descripcion) {
            $sentencia = $this->db->prepare('INSERT INTO imagen(id_pedido, ruta, descripcion) VALUES(?,?, ?)');
            $sentencia->execute(array($id_pedido, $rutaImagen, $descripcion));
            return $this->db->lastInsertId();
        }
        
        // OBTENER IMAGEN SEGÚN ID_IMAGEN
        function getImagenById($id_imagen){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_imagen = ?');         
            $sentencia->execute(array($id_imagen));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        // OBTENER ID DE PEDIDO DE ESA IMAGEN
        function getPedidoByImagen($id_imagen){
            $sentencia = $this->db->prepare('SELECT id_pedido FROM imagen WHERE id_imagen = ?');         
            $sentencia->execute(array($id_imagen));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        // ELIMINAR IMAGEN SEGÚN SU ID
        function deleteImagen($id_imagen){
            $sentencia = $this->db->prepare("DELETE FROM imagen WHERE id_imagen = ?");
            $sentencia->execute(array($id_imagen));
        }

}