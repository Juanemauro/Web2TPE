<?php 
class PedidosModel {
    // DECLARACIÓN DE ATRIBUTOS
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', '');
    }
    // Devuelve una tabla con todos los datos de TODOS los pedidos y una columna extra con el nombre del producto
    function getPedidos(){
        $sentencia = $this->db->prepare('SELECT *,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto order by cliente asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Devuelve una tabla con todos los pedidos filtrados por NOMBRE de producto
    function getPedidosByProducto($producto){
        $sentencia = $this->db->prepare('SELECT *,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto WHERE producto.nombre=?');
        $sentencia->execute(array($producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los pedidos filtrados por ID de producto -> utilizado para el restrict
    function getPedidosByIdProducto($id_producto){
        $sentencia = $this->db->prepare('SELECT *,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto WHERE producto.id_producto=?');
        $sentencia->execute(array($id_producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR ID_PRODUCTO EN FORMA ASCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByProductoDesc(){
        $sentencia = $this->db->prepare('SELECT pedido.*,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY producto.nombre desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR ID_PRODUCTO EN FORMA DESCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByProductoAsc(){
        $sentencia = $this->db->prepare('SELECT pedido.*,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY producto.nombre asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR CLIENTE EN FORMA DESCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByClienteDesc(){
        $sentencia = $this->db->prepare('SELECT pedido.*,producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY cliente desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Devuelve una tabla con todos los datos de UN DETERMINADO PRODUCTO y una columna extra con el nombre del producto
    function getPedido($id){
        $sentencia = $this->db->prepare('SELECT *, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where id_pedido= ?');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // Agrega un pedido a la tabla
    function addPedido($cliente, $direccion, $producto, $cantidad, $estado){
        $sentencia = $this->db->prepare('INSERT INTO pedido(cliente, direccion, id_producto, cantidad, estado) VALUES(?,?,?,?,?)');
        $sentencia->execute(array($cliente, $direccion, $producto, $cantidad, $estado));
    }
    // Actualiza un pedido
    function updatePedido($cliente, $direccion, $cantidad, $estado, $id_producto, $id_pedido){
        $sentencia = $this->db->prepare('UPDATE pedido SET cliente=?, direccion=?, cantidad=?, estado=?, id_producto=? WHERE id_pedido = ?');
        $sentencia->execute(array($cliente, $direccion, $cantidad, $estado, $id_producto, $id_pedido));
    }    
    // Borra un pedido
    function deletePedido($id){
        $sentencia = $this->db->prepare('DELETE FROM pedido WHERE pedido.id_pedido = ?' );
        $sentencia->execute(array($id));
    }
}
?>