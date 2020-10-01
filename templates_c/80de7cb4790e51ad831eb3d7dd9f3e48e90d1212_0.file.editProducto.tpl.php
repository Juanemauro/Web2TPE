<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 03:57:19
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\editProducto.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f73e5ffce55d9_79168094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80de7cb4790e51ad831eb3d7dd9f3e48e90d1212' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\editProducto.tpl',
      1 => 1601431018,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f73e5ffce55d9_79168094 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<slide>
    <form class="form-group" method= "GET" action="refreshProducto" >
        <div class="form-group">
            <label for="nombreProductoEditado">Nombre:</label>
            <input type="text" class="form-control" name="nombreProductoEditado" id="nombreProductoEditado" value="<?php echo $_smarty_tpl->tpl_vars['producto']->value->nombre;?>
">
        </div>
        <div>
            <label for="descripcionProductoEditado">Descripcion:</label>
            <input type="text" class="form-control" name="descripcionProductoEditado" id="descripcionProductoEditado" value="<?php echo $_smarty_tpl->tpl_vars['producto']->value->descripcion;?>
">
        </div>
        <div>
            <label for="precioProductoEditado">Precio:</label>
            <input type="number" class="form-control" name="precioProductoEditado" id="precioProductoEditado" value="<?php echo $_smarty_tpl->tpl_vars['producto']->value->precio;?>
">
            <input type="text" class="d-none" name="idProductoEditado" id="idProductoEditado" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">

        </div class="form-group">
        <button type="submit" class="btn btn-primary">Editar Producto</button> 
    </form>

 </slide>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php }
}
