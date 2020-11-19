<?php 
class PedidosModel {
    // DECLARACIÓN DE ATRIBUTOS
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_delivery;charset=utf8', 'root', '');
    }
    
    // Devuelve una tabla con la cantidad de pedidos
    function getCantidadPedidos($usuarioBusqueda, $producto, $estado){
        $sql='';
        // Filtrar por un valor de c/u + 6 combinaciones + elije todos de todos los filtros = 8 combinaciones
        if(($usuarioBusqueda!=='Todos') && ($producto!=='Todos') && ($estado!=='Todos')){ // Caso 1 - Filtra por usuario, producto y estado
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.id_usuario =? AND pedido.id_producto = ? AND pedido.estado = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($usuarioBusqueda, $producto, $estado));
        }else if(($usuarioBusqueda!=='Todos') && ($producto!=='Todos')){ // Caso 2 - Filtra por usuario y producto; estado = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.id_usuario =? AND pedido.id_producto = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($usuarioBusqueda, $producto));
        }else if(($usuarioBusqueda!=='Todos') && ($estado!=='Todos')) { // Caso 7 - Filtra por usuario y estado; producto = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario  
            WHERE (pedido.id_usuario =? AND pedido.estado = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($usuarioBusqueda, $estado)); 
        }else if (($producto!=='Todos') && ($estado!=='Todos')){ // Caso 5 - Filtra por producto y estado; usuario = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario  
            WHERE (pedido.id_producto =? AND pedido.estado = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($producto, $estado));   
        }else if($producto!=='Todos'){ // Caso 3 - Filtra por producto; usuario y estado = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario  
            WHERE (pedido.id_producto = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($producto));
        }else if ($usuarioBusqueda!=='Todos'){ // Caso 4 - Filtra por usuario; producto y estado = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.id_usuario = ?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($usuarioBusqueda));        
        }else if ($estado!=='Todos'){ // Caso 6 - Filtra por estado; usuario y producto = todos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.estado =?)';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute(array($estado));
        }else{ // Caso 8 - Selecciona "todos" en todos los campos
            $sql = 'SELECT count(*) FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->execute();
        }          
        return $sentencia->fetchColumn();
    }
    // Devuelve una tabla con todos los pedidos (para usuario público)
    function getPedidos(){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario'); 
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }             
    // Devuelve una tabla con los pedidos que van en cada página de la paginación
    function getPedidosPorPagina($usuarioBusqueda, $producto, $estado, $inicio, $fin){ 
        // Filtrar por un valor de c/u + 6 combinaciones + elije todos de todos los filtros = 8 combinaciones  
        if(($usuarioBusqueda!=='Todos') && ($producto!=='Todos') && ($estado!=='Todos')){ // Caso 1 - Filtra por usuario, producto y estado
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE ((pedido.id_usuario =:usuarioBusqueda) AND (pedido.id_producto = :producto) AND (pedido.estado = :estado)) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':usuarioBusqueda', $usuarioBusqueda, PDO::PARAM_INT);
            $sentencia->bindParam(':producto', $producto, PDO::PARAM_INT); 
            $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();
        }else if(($usuarioBusqueda!=='Todos') && ($producto!=='Todos')){ // Caso 2 - Filtra por usuario y producto; estado = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE ((pedido.id_usuario = :usuarioBusqueda) AND (pedido.id_producto = :producto)) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':producto', $producto, PDO::PARAM_INT); 
            $sentencia->bindParam(':usuarioBusqueda', $usuarioBusqueda, PDO::PARAM_INT);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();
        }else if(($usuarioBusqueda!=='Todos') && ($estado!=='Todos')) { // Caso 7 - Filtra por usuario y estado; producto = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE ((pedido.id_usuario =:usuarioBusqueda AND pedido.estado = :estado)) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':usuarioBusqueda', $usuarioBusqueda, PDO::PARAM_INT); 
            $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();
        }else if (($producto!=='Todos') && ($estado!=='Todos')){ // Caso 5 - Filtra por producto y estado; usuario = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE ((pedido.id_producto =:producto) AND (pedido.estado = :estado)) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql);            
            $sentencia->bindParam(':producto', $producto, PDO::PARAM_INT); 
            $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();
        }else if($producto!=='Todos'){ // Caso 3 - Filtra por producto; usuario y estado = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.id_producto = :producto) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':producto', $producto, PDO::PARAM_INT);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute(); 
        }else if ($usuarioBusqueda!=='Todos'){ // Caso 4 - Filtra por usuario; producto y estado = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.id_usuario = :usuarioBusqueda) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':usuarioBusqueda', $usuarioBusqueda, PDO::PARAM_INT);
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();      
        }else if ($estado!=='Todos'){ // Caso 6 - Filtra por estado; usuario y producto = todos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario 
            WHERE (pedido.estado = :estado) LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql); 
            $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR); // Representa el tipo de dato CHAR, VARCHAR de SQL, u otro tipo de datos de cadena. -> https://www.php.net/manual/es/pdo.constants.php
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); // Representa el tipo de dato INTEGER de SQL -> https://www.php.net/manual/es/pdo.constants.php
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); // Representa el tipo de dato INTEGER de SQL -> https://www.php.net/manual/es/pdo.constants.php
            $sentencia->execute();
        }else{ // Caso 8 - Selecciona "todos" en todos los campos
            $sql = 'SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.cantidad, pedido.id_usuario, producto.nombre, usuario.alias as alias 
            FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario LIMIT :inicio, :fin';
            $sentencia = $this->db->prepare($sql);             
            $sentencia->bindParam(':inicio', $inicio, PDO::PARAM_INT); 
            $sentencia->bindParam(':fin', $fin, PDO::PARAM_INT); 
            $sentencia->execute();
        }          
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con los pedidos del usuario que está loggeado
    function getPedidosByUser($usuario){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.estado, pedido.id_usuario, pedido.cantidad, producto.nombre, usuario.alias as alias FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario where pedido.id_usuario = ? order by cliente asc'); 
        $sentencia->execute(array($usuario));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // Devuelve una tabla con todos los pedidos filtrados por NOMBRE de producto
    function getPedidosByProducto($producto){
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.estado, producto.nombre, usuario.alias as alias FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto JOIN usuario ON pedido.id_usuario = usuario.id_usuario WHERE producto.nombre=?');
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
        $sentencia = $this->db->prepare('SELECT pedido.id_pedido, pedido.id_producto, pedido.direccion, pedido.cliente, pedido.cantidad, pedido.id_usuario, pedido.estado, producto.nombre FROM pedido JOIN producto ON pedido.id_producto = producto.id_producto where id_pedido= ?');
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