<?php
    class ImagenesModel{
        private $db;
        // CONSTRUCTOR
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', ''); 
        }
        // INSERTAR IMÁGENES
        function insertarImagenes($id_pedido, $ruta) {
            $sentencia = $this->db->prepare('INSERT INTO imagen(id_pedido, ruta) VALUES(?,?)');
            $sentencia->execute(array($id_pedido, $ruta));
            return $this->db->lastInsertId();
        }
        // OBTENER IMÁGENES
        function getImagenes(){
            $sentencia = $this->db->prepare('SELECT * FROM imagen');         
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        // OBTENER IMÁGENES SEGÚN ID_PEDIDO
        public function getImagenesIdPeli($id_pedido){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_pedido = ?');         
            $sentencia->execute(array($id_pedido));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        // OBTENER IMAGEN SEGÚN ID_IMAGEN
        function getImagenId($id_imagen){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_imagen = ?');         
            $sentencia->execute(array($id));
            return $query->fetch(PDO::FETCH_OBJ);
        }
        // ELIMINAR IMAGEN SEGÚN SU ID
        function deleteImagen($id_imagen){
            $sentencia = $this->db->prepare("DELETE FROM imagen WHERE id_imagen = ?");
            $sentencia->execute(array($id));
        }
        // ELIMINAR UNA IMAGEN DE UN PEDIDO
        function deleteImagenFromPedido($id_pedido){
            $query = $this->db->prepare("DELETE FROM imagen WHERE id_pedido = ?");
            $sentencia->execute(array($id_peli));
        }
}