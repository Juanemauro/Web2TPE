<?php
include_once './Models/ProductosModel.php';
include_once './Views/ProductosView.php';
class ProductosController{
    // DECLARACIÓN DE ATRIBUTOS
    private $model;
    private $productosView;
    // CONSTRUCTOR
    public function __construct() {
        $this->model = new ProductosModel();
        $this->productosView = new ProductosView();
    }
    // ------------------------ MÉTODOS 
    // Mostrar TODOS de productos
    function showProductos(){
        $productos = $this->model->getProductos();
        $this->productosView->showProductosView($productos);
    }
    // Agregar productos
    function addProductos(){
        $nombre = $_POST["nombreProducto"];
        $descripcion = $_POST["descripcionProducto"];
        $precio = $_POST["precioProducto"];
        //Verifico que ingrese todos los datos en el formulario
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)){
            $this->model->addProducto($nombre, $descripcion, $precio);
            header("Location: " . PRODUCTOS);
        }else{  
        $this->productosView->showError("Faltan campos obligatorios");
        }
    }    

    function editProducto($params = null){
        $id = $params[':ID'];
            $producto = $this->model->getProducto($id);
            $this->productosView->showUpdatedProductos($producto, $id);
    }  
    function showEditedProducto(){
        $nombre = $_GET["nombreProductoEditado"];
        $descripcion = $_GET["descripcionProductoEditado"];
        $precio = $_GET["precioProductoEditado"];
        $id = $_GET["idProductoEditado"];
        ////Verifico que los parámetros (campos del form de editar el pedido) no estén vacíos
        if (!empty($nombre) && !empty($descripcion) && !empty($precio)) {
            $this->model->updateProducto($nombre, $descripcion, $precio, $id);
            header("Location: " . PRODUCTOS);
        }else{   
            $this->productosView->showError("Faltan campos obligatorios.");
        }
    }
    function deleteProducto($params = null){
        $id=$params[':ID'];
        $this->model->deleteProducto($id);
        header("Location: " . PRODUCTOS);
    }
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE DESC
    function showOrderedProductosByNameDesc(){
        $productos = $this->model->getOrderedProductosByNameDesc();
        $this->productosView->showProductosView($productos);
    }    
    // MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN NOMBRE DE CLIENTE ASC
    function showOrderedProductosByNameAsc(){
        $productos = $this->model->getOrderedProductosByNameAsc();
        $this->productosView->showProductosView($productos);
    }
    /// MOSTRAR PRODUCTOS EN FORMA DESCENDENTE SEGÚN ID_PRODUCTO DESC
    function showOrderedProductosByPriceDesc(){
        $productos = $this->model->getOrderedProductosByPriceDesc();
        $this->productosView->showProductosView($productos);
    }
    // MOSTRAR PRODUCTOS EN FORMA ASCENDENTE SEGÚN ID_PRODUCTO ASC
    function showOrderedProductosByPriceAsc(){
        $productos = $this->model->getOrderedProductosByPriceAsc();
        $this->productosView->showProductosView($productos);
    }    
}
?>