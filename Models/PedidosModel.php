<?php 
class PedidosModel {
    // DECLARACIÓN DE ATRIBUTOS
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', '');
    }
    // Devuelve una tabla con todos los datos de TODOS los pedidos y una columna extra con el nombre del producto
    function getPedidos(){
        //$sql='';
        //$cliente='todos';
        //$id_usuario ='todos';
        //$producto ='toosad';

        //'todos' sería cuando al usuario no le importa un valor en específico
        //'valor_id_usuario', 'valor_id_producto' y cliente son los falores que vendría del form
        //if ($cliente='todos' && $id_usuario='todos' && $producto='todos'){ //1
        //    $sql='SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto order by cliente asc';
        //}else if ($cliente='todos' && $id_usuario=$valor_id_usuario && $producto=$valor_id_producto){ //2
        //    $sql='SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where pedido.id_usuario=? and producto.id_producto=? order by cliente asc';
        //}else if($cliente='todos' && $id_usuario='todos' && $producto=$valor_id_producto){ //3
        //    $sql='SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where producto.id_producto=? order by cliente asc';
        //}else if($cliente='todos' && $id_usuario=$valor_id_usuario && $producto='todos'){ //4
        //    $sql='SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where pedido.id_usuario=? order by cliente asc';        
        //} //continuar casos 5, 6 y 7
        //$sentencia = $this->db->prepare($sql);
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto order by cliente asc'); 
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Devuelve una tabla con los pedidos del usuario que está loggeado
    function getPedidosByUser($usuario){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where pedido.id_usuario = ? order by cliente asc'); 
        $sentencia->execute(array($usuario));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }


    // Devuelve una tabla con todos los pedidos filtrados por NOMBRE de producto
    function getPedidosByProducto($producto){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto WHERE producto.nombre=?');
        $sentencia->execute(array($producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los pedidos filtrados por ID de producto -> utilizado para el restrict
    function getPedidosByIdProducto($id_producto){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto WHERE producto.id_producto=?');
        $sentencia->execute(array($id_producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR ID_PRODUCTO EN FORMA ASCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByProductoDesc(){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY producto.nombre desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR ID_PRODUCTO EN FORMA DESCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByProductoAsc(){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY producto.nombre asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los datos de los pedidos (ORDENADOS POR CLIENTE EN FORMA DESCENDENTE) y una columna extra con el nombre del producto
    function getPedidosOrdenadosByClienteDesc(){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto ORDER BY cliente desc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }    
    // Devuelve una tabla con todos los datos de UN DETERMINADO PRODUCTO y una columna extra con el nombre del producto
    function getPedido($id){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where id_pedido= ?');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // Agrega un pedido a la tabla
    function addPedido($cliente, $direccion, $producto, $cantidad, $estado, $id_usuario){
        $sentencia = $this->db->prepare('INSERT INTO pedido(cliente, direccion, id_producto, cantidad, estado, id_usuario) VALUES(?,?,?,?,?,?)');
        $sentencia->execute(array($cliente, $direccion, $producto, $cantidad, $estado, $id_usuario));
        return $this->db->lastInsertId();
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