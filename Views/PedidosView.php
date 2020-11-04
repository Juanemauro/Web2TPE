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
    // Muestra los pedidos
    function showPedidosView($pedidos, $productos, $loggeado, $usuario = " ", $admin){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/Pedidos/pedidos.tpl');
    }

    function showPedidosFiltrados($pedidos, $loggeado, $usuario, $admin){
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
    function showUpdatedPedido($pedidos, $productos, $id, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "Editar pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/editPedido.tpl');
    }  
    // Muestra el detelle de un determinado pedido
    function showDetailPedido($pedido, $loggeado, $usuario, $admin){
        $this->smarty->assign('titulo', "editar pedido");
        $this->smarty->assign('pedido', $pedido);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/Pedidos/detailPedido.tpl');
    }  
}
?>