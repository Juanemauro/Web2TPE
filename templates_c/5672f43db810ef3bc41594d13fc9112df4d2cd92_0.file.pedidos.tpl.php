<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 23:43:02
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\pedidos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f74fbe6c03a85_42626980',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5672f43db810ef3bc41594d13fc9112df4d2cd92' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\pedidos.tpl',
      1 => 1601502049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f74fbe6c03a85_42626980 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
        <p>
    <form method= "GET" action="addPedido" class="form">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName4">Nombre</label>
                <input type="name" class="form-control" name="inputName" id="inputName" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastname4">Apellido</label>
                <input type="lastname" class="form-control" name="inputLastname" id="inputLastname" placeholder="Apellido">
            </div>
        </div>
        <div class="form-row">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" name="inputAddress"  id="inputAddress" placeholder="Calle XXXX DPTO XXXX">
        </div>
        <div class="form-group">
            <label for="inputPedido">Producto</label>
            <select class="form-control" name="inputPedido" id="inputPedido">
            <option value="" selected>Elegir...</option>
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
            <div class="form-group">
                <label for="inputCantidad">Cantidad</label>
                <input type="number" class="form-control" name="inputCantidad" id="inputCantidad" max="24" placeholder="1">
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="captcha">Captcha:</label>
                <input type="text" id="inputText" class="form-control">
                </div>
                <div class="form-group col-md-4">
                <label for="generatedcaptcha" class="text-white">a</label>
                <input type="text" class="form-control" id="captcha" disabled />
                </div>
                <div class="form-group col-md-4">
                <label for="button-captcha" class="text-white">a</label></br>
                <button type="button" class="btn btn-primary" id="actucaptcha">Actualizar</button>
                </div>
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="realizpedido">Realizar pedido</button>
    </form>
    </p>
    <table class="pedidos_tabla">
        <tr>
            <td><form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cliente</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedPedidosByClienteAsc">Cliente ▲</a>
                            <a class="dropdown-item" href="showOrderedPedidosByClienteDesc">Cliente ▼</a>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Producto</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedPedidosByProductoAsc">Producto ▲</a>
                            <a class="dropdown-item" href="showOrderedPedidosByProductoDesc">Producto ▼</a>
                        </div>
                    </div>
                </form>
            </td>    
            <td>Dirección</td>
            <td>Detalle</td>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pedidos']->value, 'pedido');
$_smarty_tpl->tpl_vars['pedido']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pedido']->value) {
$_smarty_tpl->tpl_vars['pedido']->do_else = false;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->cliente;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->nombre;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pedido']->value->direccion;?>
</td>
                <td><a href="detailPedido/<?php echo $_smarty_tpl->tpl_vars['pedido']->value->id_pedido;?>
" class="btn btn-primary">Detalle</a></td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
