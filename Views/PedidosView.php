<?php
require_once "./libs/smarty/Smarty.class.php";
class PedidosView{

    // DECLARACIÓN DE ATRIBUTOS
    private $smarty;

    // CONSTRUCTOR
    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->assign('basehref', BASE_URL);
    }

    // Muestra los pedidos a los usuarios loggeados
    function showPedidosView($pedidos, $productos, $loggeado, $usuario = " ", $admin, $cant_paginas, $pagina, $pedidos_por_pagina, $usuarios, $usuarioBusqueda, $producto, $estado, $cant_pedidos){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('usuarios', $usuarios);
        $this->smarty->assign('cant_paginas', $cant_paginas);
        $this->smarty->assign('pagina', $pagina);
        $this->smarty->assign('usuarioBusqueda', $usuarioBusqueda);
        $this->smarty->assign('producto', $producto);
        $this->smarty->assign('estado', $estado);
        $this->smarty->assign('cant_pedidos', $cant_pedidos);
        $this->smarty->assign('pedidos_por_pagina', $pedidos_por_pagina);
        $this->smarty->display('templates/Pedidos/pedidos.tpl');
    }

    // Pedidos visitante (público)
    function showPedidosPublico($pedidos, $productos, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Pedidos/pedidosPublico.tpl');
    }

    // Mostrar pedidos del usuario que está loggeado
    function showMyPedidos($loggeado, $usuario, $pedidosByUser, $admin, $productos){
        $this->smarty->assign('titulo', "Mis Pedidos");
        $this->smarty->assign('pedidos', $pedidosByUser);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/misPedidos.tpl');
    }

    // Muestra pedidos filtrados por producto
    function showPedidosFiltradosProducto($pedidos, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/pedidosFiltrados.tpl');
    }

    // Muestra form para realizar un nuevo pedido
    function showPedidoForm($pedidos, $productos, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Nuevo Pedido");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/newPedido.tpl');
    }

    // Muestra la tabla con todos los pedidos para elegir el que quiero editar
    function showMenuEditPedido($pedidos, $productos, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Editar Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);    
        $this->smarty->display('templates//Pedidos/menuEditPedido.tpl');
    }

    // Muestra la tabla con todos los pedidos para elegir el que quiero borrar
    function showMenuDeletePedido($pedidos, $productos, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Borrar Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/menuDeletePedido.tpl');
    }

    // Muestra un form con los pedidos actualizados
    function showUpdatedPedido($pedidos, $productos, $id, $loggeado, $usuario, $admin, $imagenes){
        $this->smarty->assign('titulo', "Editar pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('imagenes', $imagenes);
        $this->smarty->display('templates/Pedidos/editPedido.tpl');
    } 
     
    // Muestra el detelle de un determinado pedido
    function showDetailPedido($pedido, $loggeado, $usuario, $id_usuario = " ", $admin){
        $this->smarty->assign('titulo', "editar pedido");
        $this->smarty->assign('pedido', $pedido);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('id_usuario', $id_usuario);
        $this->smarty->display('templates/Pedidos/detailPedido.tpl');
    }  

    // Muestra imágenes de un pedido
    function showImagenesPedido($id_pedido, $imagenes, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Imágenes del pedido.");
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('imagenes', $imagenes);
        $this->smarty->assign('id_pedido', $id_pedido);
        $this->smarty->display('templates/Pedidos/imagenesPedido.tpl');
    }
}
?>