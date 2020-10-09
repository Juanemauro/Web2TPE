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
    function showPedidosView($pedidos, $productos, $loggeado, $usuario = " "){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/pedidos.tpl');
    }

    function showPedidosFiltrados($pedidos, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/pedidosFiltrados.tpl');
    }

    // Muestra form para realizar un nuevo pedido
    function showPedidoForm($pedidos, $productos, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Nuevo Pedido");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/newPedido.tpl');
    }
    // Muestra la tabla con todos los pedidos para elegir el que quiero editar
    function showMenuEditPedido($pedidos, $productos, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Editar Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);       
        $this->smarty->display('templates/menuEditPedido.tpl');
    }
    // Muestra la tabla con todos los pedidos para elegir el que quiero borrar
    function showMenuDeletePedido($pedidos, $productos, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Borrar Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/menuDeletePedido.tpl');
    }
    // Muestra un mensaje de error al usuario cuando no completó todos los campos del formulario
    function showError($mensajeError){
        echo "<h1>ERROR!</h1>";
        echo "<h2>{$mensajeError}</h2>";
    }
    // Muestra un form con los pedidos actualizados
    function showUpdatedPedido($pedidos, $productos, $id, $loggeado, $usuario){
        $this->smarty->assign('titulo', "Editar pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/editPedido.tpl');
    }  
    // Muestra el detelle de un determinado pedido
    function showDetailPedido($pedido, $loggeado, $usuario){
        $this->smarty->assign('titulo', "editar pedido");
        $this->smarty->assign('pedido', $pedido);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->assign('usuario', $usuario);
        $this->smarty->display('templates/detailPedido.tpl');
    }  
}
?>