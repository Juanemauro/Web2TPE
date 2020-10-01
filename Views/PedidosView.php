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
    function showPedidosView($pedidos, $productos){
        $this->smarty->assign('titulo', "Pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->display('templates/pedidos.tpl');
    }
    // Muestra un mensaje de error al usuario cuando no completó todos los campos del formulario
    function showError($mensajeError){
        echo "<h1>ERROR!</h1>";
        echo "<h2>{$mensajeError}</h2>";
    }
    // Muestra un form para hacer el update de un pedido
    function showUpdatedPedido($pedidos, $productos, $id){
        $this->smarty->assign('titulo', "editar pedidos");
        $this->smarty->assign('pedidos', $pedidos);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/editPedido.tpl');
    }  
    // Muestra el detelle de un determinado pedido
    function showDetailPedido($pedido){
        $this->smarty->assign('titulo', "editar pedido");
        $this->smarty->assign('pedido', $pedido);
        $this->smarty->display('templates/detailPedido.tpl');
    }  
}
?>