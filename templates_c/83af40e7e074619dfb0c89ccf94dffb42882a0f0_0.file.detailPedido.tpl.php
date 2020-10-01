<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-01 03:14:48
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\detailPedido.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f752d885a38c8_24225743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83af40e7e074619dfb0c89ccf94dffb42882a0f0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\detailPedido.tpl',
      1 => 1601501913,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f752d885a38c8_24225743 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
    <table class="pedidos_tabla"
        <tr>
            <td>Cliente</td>
            <td>Producto</td>
                <td>Dirección</td>
                <td>Cantidad</td>
                <td>Estado</td>
            </tr>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->cliente;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->nombre;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->direccion;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->cantidad;?>
</td>
            <?php if ($_smarty_tpl->tpl_vars['pedido']->value->entregado == 0) {?>                <td>Aun no entregado</td>
                <?php } else { ?>                 <td>Entregado</td>
            <?php }?>
        </tr>
    </table>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
