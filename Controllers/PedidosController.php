<?php
include_once './Controllers/ProductosController.php'; 
include_once './Models/PedidosModel.php';
include_once './Views/ProductosView.php';
include_once './Views/PedidosView.php';
class PedidosController {
    // DECLARACIÓN DE ATRIBUTOS
    private $pedidosModel;
    private $pedidosView;
    private $productosController;
    private $user;
    // CONSTRUCTOR
    function __construct(){
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->productosModel = new ProductosModel();
        $this->productosController = new ProductosController(); 
        $this->user = new UsersController();
    } 
    // ------------------------ MÉTODOS 
    // MOSTRAR PEDIDOS
    function Pedidos(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado);
    }
    // NEW PEDIDO
    function newPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $this->pedidosView->showPedidoForm($pedidos, $productos);
        }else{
            header("Location: " . PEDIDOS);
        }         
    }    
    // CARGAR PEDIDO
    function addPedido(){
        $cliente=$_GET["inputName"] . " ". $_GET["inputLastname"]; //concateno los datos que vienen por form
        $direccion=$_GET["inputAddress"];
        $producto=$_GET["inputPedido"];
        $cantidad=$_GET["inputCantidad"];
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($cliente) && !empty($direccion) && !empty($producto) && !empty($cantidad)){
            $this->pedidosModel->addPedido($cliente, $direccion, $producto, $cantidad);
            header("Location: " . PEDIDOS);
        }else{
            //Muestra un mensaje de error si falta algun campo del form  
            $this->pedidosView->showError("Faltan campos obligatorios.");
        }
    }
    // MUESTRA TABLA CON LOS PEDIDOS
    function menuEditPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $this->pedidosView->showMenuEditPedido($pedidos, $productos);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // EDITAR PEDIDO X
    function editPedido($params = null){
        //agregar la parte de usuario, acá sólo debería poder editar el dueño de la página (administrador)
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $this->pedidosView->showUpdatedPedido($pedido, $productos, $id);
        }else{
            header("Location: " . PEDIDOS);
        }        
    }    
    // MOSTRAR PEDIDOS ACTUALIZADOS
    function showEditedPedido(){
        $cliente = $_GET["nombrePedidoEditado"];
        $direccion = $_GET["direccionPedidoEditado"];
        $cantidad = $_GET["cantidadPedidoEditado"];
        $entregado = $_GET["entregadoPedidoEditado"];
        $id_pedido = $_GET["idPedidoEditado"];
        $id_producto = $_GET["idProductoEditado"];
        ////Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
        if (!empty($cliente) && !empty($direccion) && !empty($cantidad) && !empty($entregado) && !empty($id_producto)) {
            $this->pedidosModel->updatePedido($cliente, $direccion, $cantidad, $entregado, $id_pedido, $id_producto);
            header("Location: " . PEDIDOS);
        }else{   
          $this->pedidosView->showError("Faltan campos obligatorios.");
        }
    }
    // VER DETALLE DE PEDIDO
    function detailPedido($params=null){
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        if ($pedido)
            $this->pedidosView->showDetailPedido($pedido);
    } 
    // MUESTRA TABLA CON PEDIDOS A BORRAR
    function menuDeletePedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $this->pedidosView->showMenuDeletePedido($pedidos, $productos);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // BORRA PEDIDO X
    function deletePedido($params = null){
        $id = $params[':ID'];
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $this->pedidosModel->deletePedido($id);
            header("Location: " . PEDIDOS);
        }else{        
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoDesc(){
        $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoDesc();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        $this->pedidosView->showPedidosView($pedidos, $productos, $$loggeado);
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoAsc(){
        $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoAsc();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado);
    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteDesc(){
        $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteDesc();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado);
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteAsc(){
        $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteAsc();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado);
    }
}
?>