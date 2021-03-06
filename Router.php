<?php
// INCLUYO ROUTER CLASS Y LOS CONTROLADORES
require_once './RouterClass.php';
require_once './Controllers/HomeController.php';
require_once './Controllers/PedidosController.php';
require_once './Controllers/ProductosController.php';
require_once './Controllers/UsersController.php';
require_once './Controllers/AutenticacionController.php';
require_once './Controllers/ImagenesController.php';

// CONSTANTES PARA RUTEO
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("HOME", BASE_URL . 'showHome');
define("PEDIDOS", BASE_URL . 'Pedidos');
define("PRODUCTOS", BASE_URL . 'Productos');
define("MENUADMIN", BASE_URL . 'showMenuAdmin');
define("VERIMAGENES", BASE_URL . 'verImagenes/');
define("EDITPEDIDO", BASE_URL . 'editPedido/');
define("FAQ", BASE_URL . 'showFaq');
define("LOGIN", BASE_URL . 'login');

// Creo instancia de router
$r = new Router();

///////////////////// LOGIN, ACCIONES DE USUARIOS Y LOGOUT
$r->addRoute("login", "GET", "HomeController", "loginForm"); // Muestra el form para loggearse
$r->addRoute("verificarUser", "POST", "UsersController", "verificarUser"); // Verificar usuario y contraseña
$r->addRoute("logout", "GET", "AutenticacionController", "logout"); // Desloggearse
$r->addRoute("registroForm", "GET", "HomeController", "registroForm"); // Muestra form para registrarse
$r->addRoute("registrarse", "POST", "UsersController", "registrarUsuario"); // Registra el usuario en la BDD
$r->addRoute("selectUser", "GET", "UsersController", "selectUser"); // Mostrar form para ingresar el usuario
$r->addRoute("verificarUsuario", "POST", "UsersController", "verificarUsuario"); // Mostrar form para verificar la pregunta secreta del usuario
$r->addRoute("verificarPregunta", "POST", "UsersController", "verificarPregunta"); // Mostrar form para verificar la pregunta secreta del usuario
$r->addRoute("updatePassword", "POST", "UsersController", "updatePassword"); // Mostrar form para verificar la pregunta secreta del usuario
$r->addRoute("updatePermiso/", "GET", "UsersController", "updatePermiso"); // Error updatePermiso
$r->addRoute("updatePermiso/:ID", "GET", "UsersController", "updatePermiso"); // Hacer admin a un usuario
$r->addRoute("deleteUsuario/", "GET", "UsersController", "deleteUsuario"); // Error deleteUsuario
$r->addRoute("deleteUsuario/:ID", "GET", "UsersController", "deleteUsuario"); // Borrar un usuario

// HOME & FAQ
$r->addRoute("home", "GET", "HomeController", "showHome"); // Mostrar Home
$r->addRoute("showFaq", "GET", "HomeController", "showFaq"); // Mostrar FAQ
$r->addRoute("showMenuAdmin", "GET", "HomeController", "showMenuAdmin"); // Mostrar FAQ

// IMÁGENES
$r->addRoute("verImagenes/", "GET", "ImagenesController", "verImagenesPedido"); // Error verImagenes
$r->addRoute("verImagenes/:ID", "GET", "ImagenesController", "verImagenesPedido"); // Ver imágenes de un pedido
$r->addRoute("agregarImagenes", "POST", "ImagenesController", "agregarImagenes"); // Agregar una imagen a un pedido
$r->addRoute("eliminarImagen/", "GET", "ImagenesController", "borrarImagen"); // Error eliminarImagen
$r->addRoute("eliminarImagen/:ID", "GET", "ImagenesController", "borrarImagen"); // Borrar una imagen

// RUTAS PEDIDOS
$r->addRoute("showMyPedidos", "GET", "PedidosController", "showMyPedidos"); // muestra todos los pedidos que realizó el usuario que está loggeado en ese momento
$r->addRoute("Pedidos", "GET", "PedidosController", "Pedidos"); //-> varía para usuario público
$r->addRoute("showFiltroPedidos", "GET", "PedidosController", "showPedidosFiltradosProducto"); // Muestra los pedidos filtrados por un determinado producto
$r->addRoute("newPedido", "GET", "PedidosController", "newPedido"); // Agregar nuevo pedido a través de un form
$r->addRoute("addPedido", "POST", "PedidosController", "addPedido"); // Agrega el pedido a la BDD
$r->addRoute("menuEditPedido", "GET", "PedidosController", "menuEditPedido"); // Menu para seleccionar el pedido a editar
$r->addRoute("editPedido/", "GET", "PedidosController", "editPedido"); // Error página editPedido
$r->addRoute("editPedido/:ID", "GET", "PedidosController", "editPedido"); // Form para editar el pedido X
$r->addRoute("refreshPedido", "POST", "PedidosController", "showEditedPedido"); // 
$r->addRoute("detailPedido/", "GET", "PedidosController", "detailPedido"); // Error página deteailPedido
$r->addRoute("detailPedido/:ID", "GET", "PedidosController", "detailPedido"); // Ver detalle de un pedido
$r->addRoute("menuDeletePedido", "GET", "PedidosController", "menuDeletePedido"); // Menu para seleccionar el pedido a borrar
$r->addRoute("deletePedido/", "GET", "PedidosController", "deletePedido"); // Error página deletePedido
$r->addRoute("deletePedido/:ID", "GET", "PedidosController", "deletePedido"); // Borra el pedido de la BDD

// RUTAS PRODUCTOS
$r->addRoute("Productos", "GET", "ProductosController", "Productos"); //-> varía para usuario público
$r->addRoute("newProducto", "GET", "ProductosController", "newProducto"); // Agregar nuevo producto a través de un form
$r->addRoute("addProducto", "POST", "ProductosController", "addProductos"); // Agrega el producto a la BDD
$r->addRoute("menuEditProducto", "GET", "ProductosController", "menuEditProducto"); // Menu para seleccionar el producto a editar
$r->addRoute("editProducto/", "GET", "ProductosController", "editProducto"); // Error editProducto
$r->addRoute("editProducto/:ID", "GET", "ProductosController", "editProducto"); // Form para editar el producto X
$r->addRoute("refreshProducto", "POST", "ProductosController", "showEditedProducto"); //
$r->addRoute("menuDeleteProducto", "GET", "ProductosController", "menuDeleteProducto"); // Menu para seleccionar el pedido a borrar
$r->addRoute("deleteProducto/", "GET", "ProductosController", "deleteProducto"); // Error deleteProducto
$r->addRoute("deleteProducto/:ID", "GET", "ProductosController", "deleteProducto"); // Borra el pedido de la BDD

// Default
$r->setDefaultRoute("HomeController", "showHome");

// Run
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>