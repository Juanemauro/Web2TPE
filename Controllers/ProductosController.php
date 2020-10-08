<?php
include_once './Models/ProductosModel.php';
include_once './Views/ProductosView.php';
class ProductosController{
    // DECLARACIÓN DE ATRIBUTOS
    private $model;
    private $productosView;
    private $user;
    // CONSTRUCTOR
    public function __construct() {
        $this->model = new ProductosModel();
        $this->productosView = new ProductosView();
        $this->user = new UsersController();
    }
    // ------------------------ MÉTODOS 
    // Mostrar TODOS de productos
    function Productos(){
        $productos = $this->model->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";
        }            
        $this->productosView->showProductosView($productos, $loggeado, $usuario);
    }
    // MUESTRA FORM PARA AGREGAR UN PRODUCTO
    function newProducto(){
        $productos = $this->model->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showAddProductoForm($productos, $loggeado, $usuario);
        }else{
            header("Location: " . PRODUCTOS);
        }         
    }
    // CARGA EL PRODUCTO A LA BDD
    function addProductos(){
        $nombre = $_POST["nombreProductoNuevo"];
        $descripcion = $_POST["descripcionProductoNuevo"];
        $precio = $_POST["precioProductoNuevo"];
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)){
            $this->model->addProducto($nombre, $descripcion, $precio);
            header("Location: " . PRODUCTOS);
        }else{  
        $this->productosView->showError("Faltan campos obligatorios");
        }
    }
    // MUESTRA PEDIDOS PARA ELEGIR EL QUE QUIERO EDITAR
    function menuEditProducto(){
        $productos = $this->model->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showMenuEditProducto($productos, $loggeado, $usuario);
        }else{
            header("Location: " . PRODUCTOS);
        }    
    }
    // MUESTRA MENÚ PARA EDITAR PEDIDO
    function editProducto($params = null){
        $id = $params[':ID'];
        $producto = $this->model->getProducto($id);
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showUpdatedProductos($producto, $id, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }
        
    }  
    // ACTUALIZA LA TABLA DE PRODUCTO
    function showEditedProducto(){
        $nombre = $_GET["nombreProductoEditado"];
        $descripcion = $_GET["descripcionProductoEditado"];
        $precio = $_GET["precioProductoEditado"];
        $id = $_GET["idProductoEditado"];
        ////Verifico que los parámetros (campos del form de editar el producto) no estén vacíos
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)) {
            $this->model->updateProducto($nombre, $descripcion, $precio, $id);
            header("Location: " . PRODUCTOS);
        }else{   
            $this->productosView->showError("Faltan campos obligatorios.");
        }
    }
    // MUESTRA MENPU PARA ELEGIR PRODUCTO PARA BORRAR
    function menuDeletePedido(){
        $productos = $this->model->getProductos();
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->productosView->showMenuDeleteProducto($productos, $loggeado, $usuario);
        }else{
            header("Location: " . PEDIDOS);
        }    
    }
    // BORRA PRODUCTO X
    function deleteProducto($params = null){
        $id=$params[':ID'];
        $loggeado = $this->user->checkLoggedIn();
        if ($loggeado == true){
            $usuario = $_SESSION["ALIAS"];
            $this->model->deleteProducto($id);
            header("Location: " . PRODUCTOS);
        }else{
            header("Location: " . PRODUCTOS);
        }
    }
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE DESC
    function showOrderedProductosByNameDesc(){
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        $productos = $this->model->getOrderedProductosByNameDesc();
        $this->productosView->showProductosView($productos, $loggeado, $usuario);
    }    
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE ASC
    function showOrderedProductosByNameAsc(){
        $productos = $this->model->getOrderedProductosByNameAsc();
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        $this->productosView->showProductosView($productos, $loggeado, $usuario);
    }
    /// MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO DESC
    function showOrderedProductosByPriceDesc(){
        $productos = $this->model->getOrderedProductosByPriceDesc();
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        $this->productosView->showProductosView($productos, $loggeado, $usuario);
    }
    // MOSTRAR PRODUCTOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO ASC
    function showOrderedProductosByPriceAsc(){
        $productos = $this->model->getOrderedProductosByPriceAsc();
        $loggeado = $this->user->checkLoggedIn();
        $usuario = $_SESSION["ALIAS"];
        $this->productosView->showProductosView($productos, $loggeado, $usuario);
    }    
}
?>