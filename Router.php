<?php
// INCLUYO ROUTER CLASS Y LOS CONTROLADORES
require_once './RouterClass.php';
require_once './Controllers/HomeController.php';
require_once './Controllers/PedidosController.php';
require_once './Controllers/ProductosController.php';
require_once './Controllers/UsersController.php';

// CONSTANTES PARA RUTEO
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("HOME", BASE_URL . 'showHome');
define("PEDIDOS", BASE_URL . 'Pedidos');
define("PRODUCTOS", BASE_URL . 'Productos');
define("FAQ", BASE_URL . 'showFaq');
define("LOGIN", BASE_URL . 'login');

// Creo instancia de router
$r = new Router();

///////////////////// LOGIN, LOGOUT, REGISTRARSE
$r->addRoute("login", "GET", "UsersController", "loginForm"); // Muestra el form para loggearse
$r->addRoute("verificarUser", "POST", "UsersController", "verificarUser"); // Verificar usuario y contraseña
$r->addRoute("logout", "GET", "UsersController", "logout"); // Desloggearse
$r->addRoute("registroForm", "GET", "UsersController", "registroForm"); // Muestra form para registrarse
$r->addRoute("registrarse", "POST", "UsersController", "registrarUsuario"); // Registra el usuario en la BDD

// HOME & FAQ
$r->addRoute("home", "GET", "HomeController", "showHome"); // Mostrar Home
$r->addRoute("showFaq", "GET", "HomeController", "showFaq"); // Mostrar FAQ

// RUTAS PEDIDOS PARA USUARIO LOGGEADO
$r->addRoute("Pedidos", "GET", "PedidosController", "Pedidos"); //-> varía para usuario público
$r->addRoute("newPedido", "GET", "PedidosController", "newPedido"); // Agregar nuevo pedido a través de un form
$r->addRoute("addPedido", "GET", "PedidosController", "addPedido"); // Agrega el pedido a la BDD
$r->addRoute("menuEditPedido", "GET", "PedidosController", "menuEditPedido"); // Menu para seleccionar el pedido a editar
$r->addRoute("editPedido/:ID", "GET", "PedidosController", "editPedido"); // Form para editar el pedido X
$r->addRoute("refreshPedido", "GET", "PedidosController", "showEditedPedido"); // 
$r->addRoute("detailPedido/:ID", "GET", "PedidosController", "detailPedido"); // Ver detalle de un pedido
$r->addRoute("menuDeletePedido", "GET", "PedidosController", "menuDeletePedido"); // Menu para seleccionar el pedido a borrar
$r->addRoute("deletePedido/:ID", "GET", "PedidosController", "deletePedido"); // Borra el pedido de la BDD
$r->addRoute("showOrderedPedidosByProductoDesc", "GET", "PedidosController", "showOrderedPedidosByProductoDesc");// Ver pedidos ordenados por id_producto desc
$r->addRoute("showOrderedPedidosByProductoAsc", "GET", "PedidosController", "showOrderedPedidosByProductoAsc"); // Ver pedidos ordenados por id_producto asc
$r->addRoute("showOrderedPedidosByClienteDesc", "GET", "PedidosController", "showOrderedPedidosByClienteDesc"); // Ver pedidos ordenados por cliente desc
$r->addRoute("showOrderedPedidosByClienteAsc", "GET", "PedidosController", "showOrderedPedidosByClienteAsc"); // Ver pedidos ordenados por cliente asc

// RUTAS PRODUCTOS PARA USUARIO LOGGEADO
$r->addRoute("Productos", "GET", "ProductosController", "Productos"); //-> varía para usuario público
$r->addRoute("newProducto", "GET", "ProductosController", "newProducto"); // Agregar nuevo producto a través de un form
$r->addRoute("addProducto", "POST", "ProductosController", "addProductos"); // Agrega el producto a la BDD
$r->addRoute("menuEditProducto", "GET", "ProductosController", "menuEditProducto"); // Menu para seleccionar el producto a editar
$r->addRoute("editProducto/:ID", "GET", "ProductosController", "editProducto"); // Form para editar el producto X
$r->addRoute("refreshProducto", "GET", "ProductosController", "showEditedProducto"); //
$r->addRoute("menuDeleteProducto", "GET", "ProductosController", "menuDeletePedido"); // Menu para seleccionar el pedido a borrar
$r->addRoute("deleteProducto/:ID", "GET", "ProductosController", "deleteProducto"); // Borra el pedido de la BDD
$r->addRoute("showOrderedProductosByNameDesc", "GET", "ProductosController", "showOrderedProductosByNameDesc"); // Ver pedidos ordenados por nombre desc
$r->addRoute("showOrderedProductosByNameAsc", "GET", "ProductosController", "showOrderedProductosByNameAsc"); // Ver pedidos ordenados por nombre asc
$r->addRoute("showOrderedProductosByPriceDesc", "GET", "ProductosController", "showOrderedProductosByPriceDesc"); // Ver pedidos ordenados por precio desc
$r->addRoute("showOrderedProductosByPriceAsc", "GET", "ProductosController", "showOrderedProductosByPriceAsc"); // Ver pedidos ordenados por precio asc

// Default
$r->setDefaultRoute("HomeController", "showHome");

// Run
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>