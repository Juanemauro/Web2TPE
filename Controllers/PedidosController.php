<?php
require_once './Controllers/ProductosController.php'; 
require_once './Models/PedidosModel.php';
require_once './Views/PedidosView.php';
require_once './Controllers/AutenticacionController.php';
class PedidosController {
    // DECLARACIÓN DE ATRIBUTOS
    private $pedidosModel;
    private $pedidosView;
    private $homeView;
    private $productosController;
    private $loggeado;
    private $admin;
    private $autenticacion;
    // CONSTRUCTOR
    function __construct(){
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->homeView = new HomeView();
        $this->productosModel = new ProductosModel();
        $this->productosController = new ProductosController(); 
        $this->autenticacion = new AutenticacionController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    } 
    // ------------------------ MÉTODOS 
    // MOSTRAR PEDIDOS
    function Pedidos(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
    }

    // FILTRO DE PEDIDOS
    function showFilteredPedidos(){
        $productos = $this->productosModel->getProductos();
        $nombreProducto = $_GET["nombreProductoParaFiltrar"];
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $pedidos = $this->pedidosModel->getPedidosByProducto($nombreProducto);
        $this->pedidosView->showPedidosFiltrados($pedidos, $this->loggeado, $usuario, $this->admin);
        
    }
    // NEW PEDIDO
    function newPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showPedidoForm($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }         
    }    
    // CARGAR PEDIDO
    function addPedido(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }
        $cliente=$_POST["inputName"] . " ". $_POST["inputLastname"]; //concateno los datos que vienen por form
        $direccion=$_POST["inputAddress"];
        $producto=$_POST["inputPedido"];
        $cantidad=$_POST["inputCantidad"];
        $estado = "En preparación.";
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($cliente) && !empty($direccion) && !empty($producto) && !empty($cantidad)){
            $this->pedidosModel->addPedido($cliente, $direccion, $producto, $cantidad, $estado);
            header("Location: " . PEDIDOS);
        }else{
            //Muestra un mensaje de error si falta algun campo del form
            $seccion = "agregar pedido";  
            $this->homeView->showError("Faltan campos obligatorios.", "newPedido", $seccion, $this->loggeado, $usuario, $this->admin);
        }
    }
    // MUESTRA TABLA CON LOS PEDIDOS
    function menuEditPedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showMenuEditPedido($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // EDITAR PEDIDO X
    function editPedido($params = null){
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        $productos = $this->productosModel->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showUpdatedPedido($pedido, $productos, $id, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }        
    }    
    // MOSTRAR PEDIDOS ACTUALIZADOS
    function showEditedPedido(){
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
        }
        $cliente = $_POST["nombrePedidoEditado"];
        $direccion = $_POST["direccionPedidoEditado"];
        $cantidad = $_POST["cantidadPedidoEditado"];
        $estado = $_POST["estadoPedidoEditado"];
        $id_pedido = $_POST["idPedidoEditado"];
        $id_producto = $_POST["idProductoEditado"];
        //Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
        if (!empty($cliente) && !empty($direccion) && !empty($cantidad) && !empty($estado) && !empty($id_producto)){
            $this->pedidosModel->updatePedido($cliente, $direccion, $cantidad, $estado, $id_producto, $id_pedido);
            header("Location: " . PEDIDOS);
        }else{
            $seccion = "seleccionar un pedido";    
            $this->homeView->showError("Faltan campos obligatorios.", "menuEditPedido", $seccion, $this->loggeado, $usuario, $this->admin);
        }
    }    
    // VER DETALLE DE PEDIDO
    function detailPedido($params=null){
        $id = $params[':ID'];
        $pedido = $this->pedidosModel->getPedido($id);
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        if ($pedido)
            $this->pedidosView->showDetailPedido($pedido, $this->loggeado, $usuario, $this->admin);
    } 
    // MUESTRA TABLA CON PEDIDOS A BORRAR
    function menuDeletePedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showMenuDeletePedido($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // BORRA PEDIDO X
    function deletePedido($params = null){
        $id = $params[':ID'];
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosModel->deletePedido($id);
            header("Location: " . PEDIDOS);
        }else{        
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoDesc(){        
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoDesc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO
    function showOrderedPedidosByProductoAsc(){        
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByProductoAsc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin);            
        }else{
            header("Location: " . PEDIDOS);
        }

    }
    // MOSTRAR PEDIDOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteDesc(){             
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteDesc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
    // MOSTRAR PEDIDOS EN FORMA ASCENDENTE SEGÚN NOMBRE DE CLIENTE
    function showOrderedPedidosByClienteAsc(){        
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $pedidos = $this->pedidosModel->getPedidosOrdenadosByClienteAsc();
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PEDIDOS);
        }
    }
}
?>