<?php

class ProductosModel {

    // DECLARACIÓN DE ATRIBUTOS
    private $db;

    // CONSTRUCTOR
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', '');
    }

    // Devuelve la lista de productos en forma ascendente SEGÚN SU NOMBRE
    function getProductos(){
        $sentencia = $this->db->prepare('SELECT * FROM producto ORDER BY nombre asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Devuelve los datos de UN DETERMINADO PRODUCTO
    function getProducto($id){
        $sentencia = $this->db->prepare('SELECT * FROM producto where id_producto= ?');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    // Devuelve una tabla con todos los  datos de los productos ORDENADOS POR NOMBRE EN FORMA DESCENDENTE
    function getOrderedProductosByNameDesc(){
        $sentencia = $this->db->prepare('SELECT * FROM producto ORDER BY nombre desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
        echo $sentencia;
    }

    // Devuelve una tabla con todos los  datos de los productos ORDENADOS POR NOMBRE EN FORMA DESCENDENTE
    function getOrderedProductosByPriceDesc(){
        $sentencia = $this->db->prepare('SELECT * FROM producto ORDER BY precio desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Devuelve una tabla con todos los  datos de los productos ORDENADOS POR NOMBRE EN FORMA ASCENDENTE
    function getOrderedProductosByPriceAsc(){
        $sentencia = $this->db->prepare('SELECT * FROM producto ORDER BY precio asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Agrega un nuevo producto a la BDD
    function addProducto($nombre, $descripcion, $precio){
        $sentencia = $this->db->prepare('INSERT INTO producto(nombre, descripcion, precio) VALUES(?,?,?)');
        $sentencia->execute(array($nombre, $descripcion, $precio));
    }  

    // Actualiza un pedido en la BDD
    function updateProducto($nombre, $descripcion, $precio, $id){
        $sentencia = $this->db->prepare('UPDATE producto SET nombre=? , descripcion=?, precio=? WHERE id_producto = ?' );
        $sentencia->execute(array($nombre, $descripcion, $precio, $id));
    }

    // Borra un producto de la BDD
    function deleteProducto($id){
        $sentencia = $this->db->prepare('DELETE FROM producto WHERE producto.id_producto = ?' );
        $sentencia->execute(array($id));
    }      
}
?>