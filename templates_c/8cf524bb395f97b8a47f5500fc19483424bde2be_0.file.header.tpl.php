<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-01 03:20:25
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f752ed96c4b90_61549634',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cf524bb395f97b8a47f5500fc19483424bde2be' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\header.tpl',
      1 => 1601515223,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f752ed96c4b90_61549634 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang="en">
<head>
    <base href="BASE_URL">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
</head>
<body>
    <div class="contenedor">
        <div class="logo"><img src="images/logo.png" alt="El Azuleño" class="logo"></div>
        <div class="navbar">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showPedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showProductos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showFaq">FAQ</a>
                    </li>
                </ul>
                        </div>
            </nav>
        </div>
        <?php }
}
