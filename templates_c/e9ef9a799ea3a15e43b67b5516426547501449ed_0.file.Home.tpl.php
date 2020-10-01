<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 23:41:29
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\Home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f74fb89eca3e3_92906735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9ef9a799ea3a15e43b67b5516426547501449ed' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\Home.tpl',
      1 => 1601502041,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f74fb89eca3e3_92906735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="First slide">
        </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="Second slide">
            </div>
        <div class="carousel-item">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>
<div class="pedidos"><a href="showPedidos"><img src="images/pedidos.jpg" alt="Pedidos" class="pedidos"></a></div>
<div class="productos"><a href="showProductos"><img src="images/productos.jpg" alt="Productos" class="pedidos"></a></div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
