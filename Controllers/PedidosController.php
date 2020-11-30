<?php

require_once './Controllers/AutenticacionController.php';
require_once './Controllers/ProductosController.php'; 
require_once './Controllers/ImagenesController.php';
require_once './Models/PedidosModel.php';
require_once './Models/ImagenesModel.php';
require_once './Views/PedidosView.php';

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

    // MOSTRAR PEDIDOS
    function Pedidos(){
        $productos = $this->productosModel->getProductos();                        
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"]; // Para manejar lo que hace el usuario loggeado + haeader (siempre va a haber al menos uno, el admin "padre")
            $usuarios = $this->usersModel->getAllUsuarios(); // Traigo todos los usuarios para el filtro de búsqueda avanzada
            $usuarioBusqueda = $_GET["usuario"]; 
            $producto = $_GET["producto"]; 
            $estado = $_GET["estado"];
            if (empty($usuarioBusqueda)){ // Casos donde no se ingresa nada en el form o es la primera vez que ingresa a Pedidos
                $usuarioBusqueda = "Todos";
            }
            if (empty($producto)){
                $producto = "Todos";
            }
            if (empty($estado)){
                $estado = "Todos";
            }
            ///// ------------ PAGINACIÓN -> CANTIDAD DE PEDIDOS POR PÁGINA ------------
            $cant_pedidos = $this->pedidosModel->getCantidadPedidos($usuarioBusqueda, $producto, $estado); // Cantidad de pedidos según consulta del filtro que se indica                 
            if ($cant_pedidos == 0){ // Caso en el que no hay pedidos con esos valores o no hay pedidos
                $cant_paginas = 0; 
                $pagina = 0;
                $pedidos_por_pagina = 0;
                $inicio = 0; 
                $pedidos = $this->pedidosModel->getPedidosPorPagina($usuarioBusqueda, $producto, $estado, $inicio, $pedidos_por_pagina); 
                $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin, $cant_paginas, $pagina, $pedidos_por_pagina, $usuarios, $usuarioBusqueda, $producto, $estado, $cant_pedidos);
            }else{
                if ($_GET['items'] == null || ($_GET['items'] <= 0) || ($_GET['items'] > $cant_pedidos)){ 
                    $pedidos_por_pagina = 5; // Si entro por primera vez la cantidad default es 5 -> [inicio, pedidos por página]
                }else{
                    $pedidos_por_pagina = $_GET['items']; // Cantidad ingresada por el usuario
                }

                ///// ------------ PAGINACIÓN -> PÁGINA ACTUAL ------------ 
                $cant_paginas = ceil($cant_pedidos/$pedidos_por_pagina); // Función techo                      
                if ($_GET['pagina'] == null || ($_GET['pagina'] <= 0) || ($_GET['pagina'] > $cant_paginas )){ // Verifico a la página que debe redirigirse
                    // Primer ingreso o página inválida, redirige a la primera página
                    header('Location: ' . PEDIDOS. '?pagina=1&items='.$pedidos_por_pagina . '&usuario='. $usuarioBusqueda . '&producto='.$producto.'&estado='.$estado ); 
                }else{
                    $pagina = $_GET['pagina']; // Página actual
                }             
                $inicio = (($pagina-1)*$pedidos_por_pagina); // Primer pedido de cada página -> [inicio, pedidos por página]
                $pedidos = $this->pedidosModel->getPedidosPorPagina($usuarioBusqueda, $producto, $estado, $inicio, $pedidos_por_pagina); // Obtengo los pedidos filtrados
                $this->pedidosView->showPedidosView($pedidos, $productos, $this->loggeado, $usuario, $this->admin, $cant_paginas, $pagina, $pedidos_por_pagina, $usuarios, $usuarioBusqueda, $producto, $estado, $cant_pedidos);  
            }    
        }else{ // USUARIO PÚBLICO
            $usuario = "";
            $pedidos=$this->pedidosModel->getPedidos(); // TODOS los pedidos para cuando nadie se loggeó
            if (!empty($pedidos)){
                $this->pedidosView->showPedidosPublico($pedidos, $productos, $this->loggeado, $usuario, $this->admin);     
            }else{
                $seccion = "a Home";  
                $this->homeView->showError("Aún no se realizaron pedidos.", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
            }                
        }
    }

    // MOSTRAR PEDIDOS DEL USUARIO QUE ESTÁ LOGGEADO EN ESTE MOMENTO
    function showMyPedidos(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $id_usuario = $_SESSION["ID_USUARIO"];
            $pedidosByUser = $this->pedidosModel->getPedidosByUser($id_usuario); 
            $productos = $this->productosModel->getProductos();
            if (!empty($pedidosByUser)){
                $this->pedidosView->showMyPedidos($this->loggeado, $usuario, $pedidosByUser, $this->admin, $productos);
            }else{
                $seccion = "a Home";  
                $this->homeView->showError("Usted no tiene pedidos..", "showHome", $seccion, $this->loggeado, $usuario, $this->admin);  
            }                      
        }else{
            $usuario = "";
            header("Location: " . PEDIDOS); 
        }        
    }

    // FILTRO DE PEDIDOS -> Primera entrega
    function showPedidosFiltradosProducto(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        } 
        $productos = $this->productosModel->getProductos();
        $nombreProducto = $_GET["nombreProductoParaFiltrar"];    
        if(!empty($nombreProducto)){            
            $pedidos = $this->pedidosModel->getPedidosByProducto($nombreProducto);
            if (!empty($pedidos)){
                $this->pedidosView->showPedidosFiltradosProducto($pedidos, $this->loggeado, $usuario, $this->admin);
            }else{
                $seccion = "a Pedidos";  
                $this->homeView->showError("No existen pedidos con ese producto.", "Pedidos?usuario=Todos&producto=Todos&estado=Todos", $seccion, $this->loggeado, $usuario, $this->admin);  
            }
            
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
            if (!empty($productos)){
                $this->pedidosView->showPedidoForm($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
            }else{
                $seccion = "a Home";  
                $this->homeView->showError("Estamos realizando tareas de mantenimiento en la página, por favor inténtalo más tarde.", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
            }            
        }else{
            header("Location: " . PEDIDOS);
        }         
    } 

    // CARGAR PEDIDO
    function addPedido(){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }
        $cliente=$_POST["inputName"] . " ". $_POST["inputLastname"]; // Concateno los datos que vienen del formulario
        $direccion=$_POST["inputAddress"];
        $producto=$_POST["inputPedido"];
        $cantidad=$_POST["inputCantidad"];
        $estado = "En preparación";
        $id_usuario = $_SESSION['ID_USUARIO'];
        $descripcion=$_POST["descripcion"];          
        if (!empty($cliente) && !empty($direccion) && !empty($producto) && !empty($cantidad)){ //Verifico que ingrese todos los datos en el formulario
            $id_pedido = $this->pedidosModel->addPedido($cliente, $direccion, $producto, $cantidad, $estado, $id_usuario); // Retorno el id del último pedido para asociar las imágenes
            if ($this->admin && (!empty($_FILES['image']))){       
                $insert = $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
                if (!empty($insert)){ // Si alguna imagen no pudo subirse, esto va a tener al menos un elemento y va a mostrar el template con el error
                    $seccion1 = "Editar pedido";
                    $seccion2 = "imágenes del pedido";  
                    $redireccion1 = BASE_URL.'editPedido/'. $id_pedido;
                    $redireccion2 = BASE_URL.'verImagenes/'. $id_pedido; 
                    $this->homeView->showErrorImagen("Las siguientes imágenes no pudieron cargarse: ", $insert, $redireccion1, $redireccion2, $seccion1, $seccion2, $this->loggeado, $usuario, $this->admin);
                }else{
                    header("Location: " . PEDIDOS);
                }                     
            }           
        }else{
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
            if (!empty($pedidos)){
                $this->pedidosView->showMenuEditPedido($pedidos, $productos, $this->loggeado, $usuario, $this->admin);
            }else{
                $seccion = "Pedidos";  
                $this->homeView->showError("No hay pedidos para editar..", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
            }           
        }else{
            header("Location: " . PEDIDOS);
        }    
    }

    // EDITAR PEDIDO X
    function editPedido($params = null){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        }
        if(isset($params[':ID'])){
            $id = $params[':ID'];
            $pedido = $this->pedidosModel->getPedido($id);
            $productos = $this->productosModel->getProductos();
            $imagenes = $this->imagenesModel->getImagenesPorPedido($id);
            if ($this->admin){
                if (!empty($pedido)){
                    $this->pedidosView->showUpdatedPedido($pedido, $productos, $id, $this->loggeado, $usuario, $this->admin, $imagenes);
                }else{
                    $seccion = "al menú";  
                    $this->homeView->showError("No existe ese pedido.", "menuEditPedido", $seccion, $this->loggeado, $usuario, $this->admin);
                }
            }else{
                header("Location: " . PEDIDOS);
            }
        }else{
            $seccion = "a Home";  
            $this->homeView->showError("La página a la que intentas ingresar no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
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
        if (!empty($cliente) && !empty($direccion) && !empty($cantidad) && !empty($estado) && !empty($id_producto)){ //Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
            $this->pedidosModel->updatePedido($cliente, $direccion, $cantidad, $estado, $id_producto, $id_pedido);
            $insert = $this->imagenesController->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
                if (!empty($insert)){ // Si alguna imagen no pudo subirse, esto va a tener al menos un elemento y va a mostrar el template con el error
                    $seccion1 = "Editar pedido";
                    $seccion2 = "imágenes del pedido";  
                    $redireccion1 = BASE_URL.'editPedido/'. $id_pedido;
                    $redireccion2 = BASE_URL.'verImagenes/'. $id_pedido; 
                    $this->homeView->showErrorImagen("Las siguientes imágenes no pudieron cargarse: ", $insert, $redireccion1, $redireccion2, $seccion1, $seccion2, $this->loggeado, $usuario, $this->admin);
                }else{
                    header("Location: ".detailPedido.'/'.$id_pedido);
                }    
        }else{
            $seccion = "seleccionar un pedido";    
            $this->homeView->showError("Faltan campos obligatorios.", "menuEditPedido", $seccion, $this->loggeado, $usuario, $this->admin);
        }
    } 

    // VER DETALLE DE PEDIDO
    function detailPedido($params=null){        
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
            $id_usuario = $_SESSION["ID_USUARIO"];
        }else{
            $usuario = "";
            $id_usuario = "";
        } 
        if(isset($params[':ID'])){
            $id = $params[':ID'];
            $pedido = $this->pedidosModel->getPedido($id);
            if (!empty($pedido)){            
                $this->pedidosView->showDetailPedido($pedido, $this->loggeado, $usuario, $id_usuario, $this->admin); 
            }else{
                $seccion = "seleccionar un pedido";
                $this->homeView->showError("Este pedido no existe", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
            }      
        }else{
            $seccion = "a Home";  
            $this->homeView->showError("La página a la que intentas ingresar no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
        }              
    } 

    // MUESTRA TABLA CON PEDIDOS A BORRAR
    function menuDeletePedido(){
        $pedidos = $this->pedidosModel->getPedidos();
        $productos = $this->productosModel->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            if (!empty($pedidos)){
                $this->pedidosView->showMenuDeletePedido($pedidos, $productos, $this->loggeado, $usuario, $this->admin);            
            }else{
                $seccion = "Pedidos";  
                $this->homeView->showError("No hay pedidos para eliminar..", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . PEDIDOS);
        }    
    }

    // BORRA PEDIDO X
    function deletePedido($params = null){
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            if (isset($params[':ID'])){
                $id = $params[':ID'];
                $usuario = $_SESSION["ALIAS"];
                $pedido = $this->pedidosModel->getPedido($id);
                if (!empty($pedido)){
                    $this->pedidosModel->deletePedido($id);
                    header("Location: " . PEDIDOS. '?usuario=Todos&producto=Todos&estado=Todos');
                }else{
                    $seccion = "al menú";  
                    $this->homeView->showError("No existe ese pedido.", "menuDeletePedido", $seccion, $this->loggeado, $usuario, $this->admin);
                }
            }else{
                $seccion = "a Home";  
                $this->homeView->showError("La página a la que intentas ingresar no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            header("Location: " . PEDIDOS);
        } 
    }
}
?>