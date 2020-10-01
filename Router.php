<?php
require_once './RouterClass.php';
require_once './Controllers/HomeController.php';
require_once './Controllers/PedidosController.php';
require_once './Controllers/ProductosController.php';


// CONSTANTES PARA RUTEO
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("HOME", BASE_URL . 'showHome');
define("PEDIDOS", BASE_URL . 'showPedidos');
define("PRODUCTOS", BASE_URL . 'showProductos');
define("FAQ", BASE_URL . 'showFaq');

// Creo instancia de router
$r = new Router();

// HOME
$r->addRoute("home", "GET", "HomeController", "showHome"); //mostrar Home

// RUTAS PEDIDOS
$r->addRoute("showPedidos", "GET", "PedidosController", "showPedidos"); //mostrar pedidos
$r->addRoute("showFaq", "GET", "HomeController", "showFaq");
$r->addRoute("addPedido", "GET", "PedidosController", "addPedido"); //cargar pedidos
$r->addRoute("editPedido/:ID", "GET", "PedidosController", "editPedido"); //editar pedido
$r->addRoute("refreshPedido", "GET", "PedidosController", "showEditedPedido"); //muestra pedido actualizado
$r->addRoute("detailPedido/:ID", "GET", "PedidosController", "detailPedido"); //ver detalle de un pedido
$r->addRoute("deletePedido/:ID", "GET", "PedidosController", "deletePedido"); //borar un pedido
$r->addRoute("showOrderedPedidosByProductoDesc", "GET", "PedidosController", "showOrderedPedidosByProductoDesc");// ver pedidos ordenados por id_producto desc
$r->addRoute("showOrderedPedidosByProductoAsc", "GET", "PedidosController", "showOrderedPedidosByProductoAsc"); // ver pedidos ordenados por id_producto asc
$r->addRoute("showOrderedPedidosByClienteDesc", "GET", "PedidosController", "showOrderedPedidosByClienteDesc"); // ver pedidos ordenados por cliente desc
$r->addRoute("showOrderedPedidosByClienteAsc", "GET", "PedidosController", "showOrderedPedidosByClienteAsc"); // ver pedidos ordenados por cliente asc

// RUTAS PRODUCTOS
// Estos los usé para probar los que hice de pedidos
$r->addRoute("showProductos", "GET", "ProductosController", "showProductos"); //mostrar productos
$r->addRoute("showOrderedProductosByNameDesc", "GET", "ProductosController", "showOrderedProductosByNameDesc");
$r->addRoute("showOrderedProductosByNameAsc", "GET", "ProductosController", "showOrderedProductosByNameAsc");
$r->addRoute("showOrderedProductosByPriceDesc", "GET", "ProductosController", "showOrderedProductosByPriceDesc");
$r->addRoute("showOrderedProductosByPriceAsc", "GET", "ProductosController", "showOrderedProductosByPriceAsc");
$r->addRoute("addProducto", "POST", "ProductosController", "addProductos"); //cargar productos
// Al addProducto Por ahora escribilo en la URL o hacelo desde phpmyadmin, cuando tengamos usuarios va a haber una página que va a mostrar un form para cargar un producto
// la podés hacer con un cargarPedido.tpl y después le cambiamos el nombre (cuando tengamos los usuarios)
// Router -> ProductosController -> ProductosModel-> ProductosController -> ProductosView -> crear template
// Implentá estos:
// Editar Producto
// Refresh Producto 
// Borrar Producto
$r->addRoute("editProducto/:ID", "GET", "ProductosController", "editProducto"); //muestra pedido actualizado

// Refresh Producto
$r->addRoute("refreshProducto", "GET", "ProductosController", "showEditedProducto"); 
// Borrar Producto
$r->addRoute("deleteProducto/:ID", "GET", "ProductosController", "deleteProducto");

// Default
$r->setDefaultRoute("HomeController", "showHome");

// Run
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>