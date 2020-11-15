<?php
require_once './Controllers/ProductosController.php'; 
require_once './Models/PedidosModel.php';
require_once './Views/PedidosView.php';
require_once './Controllers/AutenticacionController.php';
require_once './Models/ImagenesModel.php';
require_once './Controllers/ImagenesController.php';

class PedidosController {
    // DECLARACIÓN DE ATRIBUTOS
    private $pedidosModel;
    private $pedidosView;
    private $homeView;
    private $productosController;
    private $loggeado;
    private $admin;
    private $autenticacion;
    private $imagenesModel;
    private $imagenesController;
    // CONSTRUCTOR
    function __construct(){
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->homeView = new HomeView();
        $this->productosModel = new ProductosModel();
        $this->productosController = new ProductosController(); 
        $this->autenticacion = new AutenticacionController();
        $this->imagenesModel = new ImagenesModel();
        $this->imagenesController = new ImagenesController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    } 
    // ------------------------ MÉTODOS 
    // MOSTRAR PEDIDOS
    function Pedidos(){                   
        $productos = $this->productosModel->getProductos();
        $all_pedidos = $this->pedidosModel->getPedidos();
        // CANTIDAD DE PEDIDOS y CANTIDAD DE PÁGINAS PARA CALCULAR LA PAGINACIÓN
        $pedidos_por_pagina = 5; // opcional paginación  
        $cant_pedidos = $this->pedidosModel->getCantidadPedidos(); // opcional paginación
        $cant_paginas = ceil($cant_pedidos->cantidad/$pedidos_por_pagina); // función techo -> opcional paginación
        // VERIFICO LA PÁGINA A LA QUE DEBE REDIRIGIRSE
        if ($_GET['pagina'] == null || ($_GET['pagina'] <= 0) || ($_GET['pagina'] > $cant_paginas)){
            header('Location: ' . PEDIDOS. '?pagina=1'); // si entro por primera vez a Pedidos o el usuario quiere entrar a un núm de página inválida, redirige a la 1
        }else{
            $pagina = $_GET['pagina']; // obtener página actual -> opcional paginación
        } 
        // DETERMINO LA CANTIDAD DE PEDIDOS POR PAGINA Y CON ESO, EL PRIMER Y ÚLTIMO PEDIDO DE CADA PÁGINA
        $inicio = (($pagina-1)*$pedidos_por_pagina); // primer pedido de cada página
        $pedidos = $this->pedidosModel->getPedidosPorPagina($inicio, $pedidos_por_pagina);      
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";           
        } 
        $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin, $cant_paginas, $pagina);
    }
    // MOSTRAR PEDIDOS DEL USUARIO QUE ESTÁ LOGGEADO EN ESTE MOMENTO
    function showMyPedidos(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $id_usuario = $_SESSION["ID_USUARIO"];
            $pedidosByUser = $this->pedidosModel->getPedidosByUser($id_usuario); // ACOMODAR CON INNER JOIN CUANDO HAGA LA RELACIÓN
            $productos = $this->productosModel->getProductos();
            $this->pedidosView->showMyPedidos($this->loggeado, $usuario, $pedidosByUser, $this->admin, $productos);
        }else{
            $usuario = "";
            header("Location: " . PEDIDOS); 
        }        
    }

    // FILTRO DE PEDIDOS
    function showPedidosFiltradosProducto(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $productos = $this->productosModel->getProductos();
        $nombreProducto = $_GET["nombreProductoParaFiltrar"];  
        //var_dump($nombreProducto);
        //die();      
        if(!empty($nombreProducto)){            
            $pedidos = $this->pedidosModel->getPedidosByProducto($nombreProducto);
            $this->pedidosView->showPedidosFiltradosProducto($pedidos, $this->loggeado, $usuario, $this->admin);
        }else{
            $seccion = "a pedidos";  
            $this->homeView->showError("Faltan campos obligatorios.", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
        }        
        
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
        $id_usuario = $_SESSION['ID_USUARIO'];
        $descripcion=$_POST["descripcion"];  
        //echo $id_usuario;
        //die();
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($cliente) && !empty($direccion) && !empty($producto) && !empty($cantidad)){
            $id_pedido = $this->pedidosModel->addPedido($cliente, $direccion, $producto, $cantidad, $estado, $id_usuario); // retorno el id del último pedido para asociar las imágenes
            if ($this->admin && (!empty($_FILES['image']) && (!empty($descripcion)))){        
                $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
            }
            header("Location: " . PEDIDOS);
        }else{
            // Muestra un mensaje de error si falta algun campo del form
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
        $imagenes = $this->imagenesModel->getImagenesPorPedido($id);
        if (!empty($pedido)){
            if ($this->admin){
                $usuario = $_SESSION["ALIAS"];
                $this->pedidosView->showUpdatedPedido($pedido, $productos, $id, $this->loggeado, $usuario, $this->admin, $imagenes);
            }else{
                header("Location: " . PEDIDOS);
            } 
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
            $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario);
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
        //$imagenes = $this->imagenesController->getImagenes();
        if (!empty($pedido)){
            if ($this->loggeado){
                $usuario = $_SESSION["ALIAS"];
                $id_usuario = $_SESSION["ID_USUARIO"];
            }else{
                $usuario = "";
                $id_usuario = "";
            } 
        $this->pedidosView->showDetailPedido($pedido, $this->loggeado, $usuario, $id_usuario, $this->admin); 
        }else{
            header("Location: " . PEDIDOS);
        }        
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