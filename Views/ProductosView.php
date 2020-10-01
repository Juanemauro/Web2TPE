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
    function showProductosView($productos) {
        $this->smarty->assign('titulo', "Productos");
        $this->smarty->assign('productos', $productos);
        $this->smarty->display('templates/productos.tpl');
    } 
    // Muestra mensaje de error
    function mostrarError($mensajeError){
        echo "<h1>ERROR!</h1>";
        echo "<h2>{$mensajeError}</h2>";
    }
    function showUpdatedProductos($producto, $id){  
        $this->smarty->assign('titulo', "editar producto");
        $this->smarty->assign('producto', $producto);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/editProducto.tpl');
    }
}
?>