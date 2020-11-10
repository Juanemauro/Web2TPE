<?php
require_once './Models/ProductosModel.php';
require_once './Views/ProductosView.php';
require_once './Views/PedidosView.php';
require_once './Controllers/AutenticacionController.php';
class ProductosController{
    // DECLARACIÓN DE ATRIBUTOS
    private $model;
    private $productosView;
    private $homeView;
    private $pedidosModel;
    private $loggeado;
    private $admin;
    private $autenticacion;
    // CONSTRUCTOR
    function __construct() {
        $this->model = new ProductosModel();
        $this->productosView = new ProductosView();
        $this->homeView = new PedidosView();
        $this->pedidosModel = new PedidosModel();
        $this->homeView = new HomeView();
        $this->autenticacion = new AutenticacionController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    }

    // Mostrar TODOS de productos
    function Productos(){
        $productos = $this->model->getProductos();
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        }            
        $mensaje = '';
        $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
    }
    // MUESTRA FORM PARA AGREGAR UN PRODUCTO
    function newProducto(){
        $productos = $this->model->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showAddProductoForm($productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }         
    }
    // CARGA EL PRODUCTO A LA BDD
    function addProductos(){
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
        }
        $nombre = $_POST["nombreProductoNuevo"];
        $descripcion = $_POST["descripcionProductoNuevo"];
        $precio = $_POST["precioProductoNuevo"];
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)){
            $this->model->addProducto($nombre, $descripcion, $precio);
            header("Location: " . PRODUCTOS);
        }else{  
            $seccion = "agregar producto";  
            $this->homeView->showError("Faltan campos obligatorios.", "newProducto", $seccion, $this->loggeado, $usuario, $this->admin);
        }
    }
    // MUESTRA PEDIDOS PARA ELEGIR EL QUE QUIERO EDITAR
    function menuEditProducto(){
        $productos = $this->model->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showMenuEditProducto($productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }    
    }
    // MUESTRA MENÚ PARA EDITAR PEDIDO
    function editProducto($params = null){
        $id = $params[':ID'];
        $producto = $this->model->getProducto($id);
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showUpdatedProductos($producto, $id, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }
        
    }  
    // ACTUALIZA LA TABLA DE PRODUCTO
    function showEditedProducto(){
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
        }
        $nombre = $_POST["nombreProductoEditado"];
        $descripcion = $_POST["descripcionProductoEditado"];
        $precio = $_POST["precioProductoEditado"];
        $id = $_POST["idProductoEditado"];
        ////Verifico que los parámetros (campos del form de editar el producto) no estén vacíos
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)) {
            $this->model->updateProducto($nombre, $descripcion, $precio, $id);
            header("Location: " . PRODUCTOS);
        }else{   
            $seccion = "seleccionar producto";    
            $this->homeView->showError("Faltan campos obligatorios.", "menuEditProducto", $seccion, $this->loggeado, $usuario, $this->admin);
        }
    }
    // MUESTRA MENPU PARA ELEGIR PRODUCTO PARA BORRAR
    function menuDeleteProducto(){
        $productos = $this->model->getProductos();
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showMenuDeleteProducto($productos, $this->loggeado, $usuario, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }    
    }
    // BORRA PRODUCTO X
    function deleteProducto($params = null){
        $id=$params[':ID'];
        if ($this->admin){
            $usuario = $_SESSION["ALIAS"];
            $existeEnPedido = $this->pedidosModel->getPedidosByIdProducto($id);
            if ($existeEnPedido){
                $productos = $this->model->getProductos();
                $mensaje = 'No puedes borrar un producto que esté dentro de un pedido. Por favor vuelve a elegir un producto.';
                $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
            }else{
                $this->model->deleteProducto($id);
                header("Location: " . PRODUCTOS);
            }            
        }else{
            header("Location: " . PRODUCTOS);
        }
    }
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE DESC
    function showOrderedProductosByNameDesc(){
        $usuario = $_SESSION["ALIAS"];
        if ($this->loggeado){
            $productos = $this->model->getOrderedProductosByNameDesc();
            $mensaje = '';
            $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }
    }    
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE ASC
    function showOrderedProductosByNameAsc(){        
        $usuario = $_SESSION["ALIAS"];
        if ($this->loggeado){
            $productos = $this->model->getOrderedProductosByNameAsc();
            $mensaje = '';
            $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }   
    }
    /// MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO DESC
    function showOrderedProductosByPriceDesc(){        
        $usuario = $_SESSION["ALIAS"];
        if ($this->loggeado){
            $productos = $this->model->getOrderedProductosByPriceDesc();
            $mensaje = '';
            $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }  
    }
    // MOSTRAR PRODUCTOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO ASC
    function showOrderedProductosByPriceAsc(){
        $usuario = $_SESSION["ALIAS"];
        if ($this->loggeado){
            $productos = $this->model->getOrderedProductosByPriceAsc();
            $mensaje = '';
            $this->productosView->showProductosView($productos, $this->loggeado, $usuario, $mensaje, $this->admin);
        }else{
            header("Location: " . PRODUCTOS);
        }
    }    
}
?>