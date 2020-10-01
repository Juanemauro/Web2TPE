<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 23:43:04
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\productos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f74fbe84b4990_73498507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e7916191bcc2a552f5bea0bc667b9815d6a71b5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\productos.tpl',
      1 => 1601502055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f74fbe84b4990_73498507 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
    <table class="pedidos_tabla">
        <tr>
            <td>
                <form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedProductosByNameAsc">Nombre ▲</a>
                            <a class="dropdown-item" href="showOrderedProductosByNameDesc">Nombre ▼</a>
                        </div>
                    </div>
                </form>
            </td> 
            <td>Descripcion</td>
            <td>
                <form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precio</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedProductosByPriceAsc">Precio ▲ </a>
                            <a class="dropdown-item" href="showOrderedProductosByPriceDesc">Precio ▼</a>
                        </div>
                    </div>
                </form>
            </td> 
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productos']->value, 'producto');
$_smarty_tpl->tpl_vars['producto']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['producto']->value) {
$_smarty_tpl->tpl_vars['producto']->do_else = false;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['producto']->value->nombre;?>
</td>                    
                <td><?php echo $_smarty_tpl->tpl_vars['producto']->value->descripcion;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['producto']->value->precio;?>
</td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
