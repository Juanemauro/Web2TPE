<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-01 03:14:57
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\editPedido.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f752d91cb4d68_59823112',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9b9fa6e01eb11a30db66e892c7eb94cf4a47d23' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\editPedido.tpl',
      1 => 1601501935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f752d91cb4d68_59823112 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
    <form class="form-group" method= "GET" action="refreshPedido" >
        <div class="form-group">
            <label for="nombrePedidoEditado">Nombre:</label>
            <input type="text" class="form-control" name="nombrePedidoEditado" id="nombrePedidoEditado" value="<?php echo $_smarty_tpl->tpl_vars['pedidos']->value->cliente;?>
">
        </div>
        <div>
            <label for="direccionPedidoEditado">Dirección:</label>
            <input type="text" class="form-control" name="direccionPedidoEditado" id="direccionPedidoEditado" value="<?php echo $_smarty_tpl->tpl_vars['pedidos']->value->direccion;?>
">
        </div>
                
        <div>
            <label for="idProductoEditado">Producto</label>
            <select class="form-control" name="idProductoEditado" id="idProductoEditado">
            <option value="" selected>Elegir..</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productos']->value, 'producto');
$_smarty_tpl->tpl_vars['producto']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['producto']->value) {
$_smarty_tpl->tpl_vars['producto']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['producto']->value->id_producto;?>
"> <?php echo $_smarty_tpl->tpl_vars['producto']->value->nombre;?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>            
            </select>
        </div>
        <div>
            <label for="cantidadPedidoEditado">Cantidad:</label>
            <input type="number" class="form-control" name="cantidadPedidoEditado" id="cantidadPedidoEditado" value="<?php echo $_smarty_tpl->tpl_vars['pedidos']->value->cantidad;?>
">
        </div class="form-group">
            <div>
            <label for="entregadoPedidoEditado">Estado:</label>
                <input type="number" class="form-control" name="entregadoPedidoEditado" id="entregadoPedidoEditado" value="<?php echo $_smarty_tpl->tpl_vars['pedidos']->value->entregado;?>
">
                <input type="text" class="d-none" name="idPedidoEditado" id="idPedidoEditado" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
            </div>
        <button type="submit" class="btn btn-primary">Editar Pedido</button> 
    </form>
 </div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
