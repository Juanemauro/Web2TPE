<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-09 00:55:04
  from 'C:\xampp\htdocs\Proyectos\Web2TPE\templates\headerLoggeado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f7f98c8e96575_07240024',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10c90e4fb20445e9e4d1e90dd2bd3c00aad539dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\Web2TPE\\templates\\headerLoggeado.tpl',
      1 => 1602195704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f7f98c8e96575_07240024 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang="en">
<head>
    <base href="<?php echo BASE_URL;?>
">    
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
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Pedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showFaq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</button>
                    </li>                    
                    <li class="nav-item">
                        <a href="logout" class="btn btn-primary">Logout</a>
                    </li>
                </ul>
            </div>
            </nav>
        </div>
<?php }
}
