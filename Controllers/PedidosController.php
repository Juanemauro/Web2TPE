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
    private $usersModel;
    // CONSTRUCTOR
    function __construct(){
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->homeView = new HomeView();
        $this->productosModel = new ProductosModel();
        $this->usersModel = new UsersModel();
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
        if ($this->loggeado){
            ///// ------------ PAGINACIÓN -> CANTIDAD DE PEDIDOS POR PÁGINA ------------
            $cant_pedidos = $this->pedidosModel->getCantidadPedidos(); 
            if ($_GET['items'] == null || ($_GET['items'] <= 0) || ($_GET['items'] > $cant_pedidos)){
                $pedidos_por_pagina = 5; // si entro por primera vez la cantidad default es 5
            }else{
                $pedidos_por_pagina = $_GET['items']; // cantidad ingresada por el usuario
            } 
            ///// ------------ PAGINACIÓN -> PÁGINA ACTUAL ------------
            $cant_paginas = ceil($cant_pedidos->cantidad/$pedidos_por_pagina); // función techo
            // Verifico a la página que debe redirigirse
            if ($_GET['pagina'] == null || ($_GET['pagina'] <= 0) || ($_GET['pagina'] > $cant_paginas)){
                header('Location: ' . PEDIDOS. '?pagina=1&items='.$pedidos_por_pagina); // primer ingreso o página inválida, redirige a la primera página
            }else{
                $pagina = $_GET['pagina']; // página actual
            } 
            // Determino la cantidad de pedidos por páginas para establecer el intervalo de pedidos
            $inicio = (($pagina-1)*$pedidos_por_pagina); // primer pedido de cada página
            $pedidos = $this->pedidosModel->getPedidosPorPagina($inicio, $pedidos_por_pagina); 
            $usuario = $_SESSION["ALIAS"]; // Para manejar lo que hace el usuario loggeado + haeader
            $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin, $cant_paginas, $pagina, $pedidos_por_pagina);  
        }else{
            $usuario = "";
            $pedidos=$this->pedidosModel->getPedidos(); // TODOS los pedidos para cuando nadie se loggeó
            $this->pedidosView->showPedidosPublico($pedidos, $productos, $this->loggeado, $usuario, $this->admin);         
        }
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
    // MOSTRAR FORM PARA BÚSQUEDA AVANZADA
    function menuBusqueda(){
        $productos = $this->productosModel->getProductos();
        $usuarios = $this->usersModel->getAllUsuarios(); 
        if ($this->loggeado || $this->adin){
            $usuario = $_SESSION["ALIAS"];
            $this->pedidosView->showFormBusquedaAvanzada($this->loggeado, $usuario, $this->admin, $usuarios, $productos);
        }else{
            header("Location: " . PEDIDOS);
        }        
    }   
    // MOSTRAR PEDIDOS BÚSQUEDA AVANZADA
    function busquedaAvanzada(){
        $usuarioBusqueda = $_POST["usuario"]; 
        $producto = $_POST["producto"]; 
        $estado = $_POST["estado"];   
        $productos = $this->productosModel->getProductos();
        $usuarios = $this->usersModel->getAllUsuarios();        
        if ($this->loggeado || $this->adin){
            $usuario = $_SESSION["ALIAS"];
            if (!empty($usuarioBusqueda) && !empty($producto) && !empty($estado)){
                $pedidos = $this->pedidosModel->getPedidosBusquedaAvanzada($usuarioBusqueda, $producto, $estado); // pedidos filtrados con búsqueda avanzada
                $_SESSION['url'] = $_SERVER['HTTP_REFERER'];
                $pagina_anterior = $_SESSION['url'];
                $this->pedidosView->showBusquedaAvanzada($this->loggeado, $usuario, $this->admin, $usuarios, $productos, $pedidos, $pagina_anterior);
            }else{
                $seccion = "a realizar una búsqueda avanzada";  
                $this->homeView->showError("Faltan campos obligatorios.", "showBusquedaAvanzadaForm", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . PEDIDOS);
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
            if ($this->admin && (!empty($_FILES['image']))){  
                echo 'entra';      
                $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
                echo 'sale e inserta';
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
        $descripcion=$_POST["descripcion"];  
        //Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
        if (!empty($cliente) && !empty($direccion) && !empty($cantidad) && !empty($estado) && !empty($id_producto)){
            $this->pedidosModel->updatePedido($cliente, $direccion, $cantidad, $estado, $id_producto, $id_pedido);
            $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
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
}
?>