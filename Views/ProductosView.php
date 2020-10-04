<?php
require_once "./libs/smarty/Smarty.class.php";
class ProductosView {
    // DECLARACIÓN DE ATRIBUTOS
    private $smarty;
    // CONSTRUCTOR
    function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->assign('basehref', BASE_URL);
    }
    // Muestra los productos
    function showProductosView($productos, $loggeado){
        $this->smarty->assign('titulo', "Productos");
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('loggeado', $loggeado);
        $this->smarty->display('templates/productos.tpl');
    } 
    // Muestra un form para agregar un producto
    function showAddProductoForm($productos){        
        $this->smarty->assign('titulo', "Agregar Productos");
        $this->smarty->assign('productos', $productos);
        $this->smarty->display('templates/newProducto.tpl');
    }
    // Muestra la tabla con todos los productos para elegir el que quiero editar
    function showMenuEditProducto($productos){
        $this->smarty->assign('titulo', "Editar Productos");
        $this->smarty->assign('productos', $productos);
        $this->smarty->display('templates/menuEditProducto.tpl');
    }
    // Muestra mensaje de error
    function mostrarError($mensajeError){
        echo "<h1>ERROR!</h1>";
        echo "<h2>{$mensajeError}</h2>";
    }
    // Muestra la tabla con todos los pedidos para elegir el que quiero borrar
    function showMenuDeleteProducto($productos){
        $this->smarty->assign('titulo', "Borrar Productos");
        $this->smarty->assign('productos', $productos);
        $this->smarty->display('templates/menuDeleteProducto.tpl');
    }
    // Muestra la tabla actualizada de los productos
    function showUpdatedProductos($producto, $id){  
        $this->smarty->assign('titulo', "Editar producto");
        $this->smarty->assign('producto', $producto);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/editProducto.tpl');
    }
}
?>