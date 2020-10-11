<?php
include_once './Controllers/ProductosController.php'; 
include_once './Models/PedidosModel.php';
include_once './Views/ProductosView.php';
include_once './Views/PedidosView.php';
class PedidosController {
    // DECLARACIÓN DE ATRIBUTOS
    private $pedidosModel;
    private $pedidosView;
    private $homeView;
    private $productosController;
    private $user;
    // CONSTRUCTOR
    function __construct(){
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->homeView = new HomeView();
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
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado, $usuario);
    }

    // FILTRO DE PEDIDOS
    function showFilteredPedidos(){
        $productos = $this->productosModel->getProductos();
        $nombreProducto = $_GET["nombreProductoParaFiltrar"];
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $pedidos = $this->pedidosModel->getPedidosByProducto($nombreProducto);
        $this->pedidosView->showPedidosFiltrados($pedidos, $loggeado, $usuario);
        
    }
    // NEW PEDIDO
    function newPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showPedidoForm($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }         
    }    
    // CARGAR PEDIDO
    function addPedido(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }
        $cliente=$_POST["inputName"] . " ". $_POST["inputLastname"]; //concateno los datos que vienen por form
        $direccion=$_POST["inputAddress"];
        $producto=$_POST["inputPedido"];
        $cantidad=$_POST["inputCantidad"];
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($cliente) && !empty($direccion) && !empty($producto) && !empty($cantidad)){
            $this->pedidosModel->addPedido($cliente, $direccion, $producto, $cantidad);
            header("Location: " . PEDIDOS);
        }else{
            //Muestra un mensaje de error si falta algun campo del form
            $seccion = "agregar pedido";  
            $this->homeView->showError("Faltan campos obligatorios.", "newPedido", $seccion, $loggeado, $usuario);
        }
    }
    // MUESTRA TABLA CON LOS PEDIDOS
    function menuEditPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showMenuEditPedido($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // EDITAR PEDIDO X
    function editPedido($params = null){
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showUpdatedPedido($pedido, $productos, $id, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }        
    }    
    // MOSTRAR PEDIDOS ACTUALIZADOS
    function showEditedPedido(){
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }
        $cliente = $_POST["nombrePedidoEditado"];
        $direccion = $_POST["direccionPedidoEditado"];
        $cantidad = $_POST["cantidadPedidoEditado"];
        $entregado = $_POST["entregadoPedidoEditado"];
        $id_pedido = $_POST["idPedidoEditado"];
        $id_producto = $_POST["idProductoEditado"];
        
        //Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
        if (!empty($cliente) && !empty($direccion) && !empty($cantidad) && !empty($entregado) && !empty($id_producto)){
            $this->pedidosModel->updatePedido($cliente, $direccion, $cantidad, $entregado, $id_pedido, $id_producto);
            header("Location: " . PEDIDOS);
        }else{
            $seccion = "seleccionar un pedido";    
            $this->homeView->showError("Faltan campos obligatorios.", "menuEditPedido", $seccion, $loggeado, $usuario);
        }
    }    
    // VER DETALLE DE PEDIDO
    function detailPedido($params=null){
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        if ($pedido)
            $this->pedidosView->showDetailPedido($pedido, $loggeado, $usuario);
    } 
    // MUESTRA TABLA CON PEDIDOS A BORRAR
    function menuDeletePedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showMenuDeletePedido($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // BORRA PEDIDO X
    function deletePedido($params = null){
        $id = $params[':ID'];
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosModel->deletePedido($id);
            header("Location: " . PEDIDOS);
        }else{        
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoDesc(){        
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        if ($loggeado == true){
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoDesc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoAsc(){        
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        if ($loggeado == true){
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoAsc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado, $usuario);            
        }else{
            header("Location: " . PEDIDOS);
        }

    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteDesc(){        
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        if ($loggeado == true){
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteDesc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteAsc(){        
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        if ($loggeado == true){
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteAsc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
}
?>