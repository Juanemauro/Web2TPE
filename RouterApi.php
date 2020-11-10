<?php
require_once 'RouterClass.php';
require_once 'api/ComentariosController.php';

// instacio el router
$router = new Router();

// armo la tabla de ruteo de la API REST
$router->addRoute('comentarios', 'GET', 'ComentariosController', 'getComentarios'); // trae TODOS los comentarios
$router->addRoute('comentarios/:ID', 'GET', 'ComentariosController', 'getComentariosPedido'); // trae todos los comentarios de un pedido en especial
$router->addRoute('comentario/:ID', 'DELETE', 'ComentariosController', 'borrarComentario');
$router->addRoute('comentario', 'POST', 'ComentariosController', 'agregarComentario');
$router->addRoute('comentario/:ID', 'PUT', 'ComentariosController', 'updateComentario');


 //run
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 