<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-09 00:54:58
  from 'C:\xampp\htdocs\Proyectos\Web2TPE\templates\Home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f7f98c2d3bc89_07002488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f21eef7c6bd491c27564f5c399e8c8379f30b086' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\Web2TPE\\templates\\Home.tpl',
      1 => 1602197539,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/headerLoggeado.tpl' => 1,
    'file:templates/headerPublico.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f7f98c2d3bc89_07002488 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['loggeado']->value == true) {?>
    <?php $_smarty_tpl->_subTemplateRender('file:templates/headerLoggeado.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
    <?php $_smarty_tpl->_subTemplateRender('file:templates/headerPublico.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
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
<div class="pedidos"><a href="Pedidos"><img src="images/pedidos.jpg" alt="Pedidos" class="pedidos"></a></div>
<div class="productos"><a href="Productos"><img src="images/productos.jpg" alt="Productos" class="pedidos"></a></div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
