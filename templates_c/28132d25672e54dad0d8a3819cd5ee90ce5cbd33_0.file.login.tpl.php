<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-09 00:55:00
  from 'C:\xampp\htdocs\Proyectos\Web2TPE\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f7f98c4968861_06983134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28132d25672e54dad0d8a3819cd5ee90ce5cbd33' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\Web2TPE\\templates\\login.tpl',
      1 => 1602194768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/headerPublico.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f7f98c4968861_06983134 (Smarty_Internal_Template $_smarty_tpl) {
?>
    <?php $_smarty_tpl->_subTemplateRender('file:templates/headerPublico.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="slide">
    <form action="verificarUser" method="post">
        <div class="form-group">
            <label for="user">Alias</label>
            <input class="form-control" id="alias" name="alias" aria-describedby="emailHelp" placeholder="Alias">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
        <?php if ($_smarty_tpl->tpl_vars['aviso']->value != '') {?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_smarty_tpl->tpl_vars['aviso']->value;?>

            </div>
        <?php }?>
    </form>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
