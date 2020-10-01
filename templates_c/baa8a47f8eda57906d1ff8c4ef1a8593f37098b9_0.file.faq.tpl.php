<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-01 03:11:09
  from 'C:\xampp\htdocs\Proyectos\TPEWEB2\templates\faq.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f752cadad5ea1_68153889',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'baa8a47f8eda57906d1ff8c4ef1a8593f37098b9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Proyectos\\TPEWEB2\\templates\\faq.tpl',
      1 => 1601514444,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.tpl' => 1,
    'file:templates/footer.tpl' => 1,
  ),
),false)) {
function content_5f752cadad5ea1_68153889 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:templates/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="slide">
    <p>
        <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">¿Cuáles son los medios de pago habilitados para pagar?</button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Podés pagar a través tarjetas de crédito y tarjetas de débito.</br>
                            arjetas de crédito: American Express, MasterCard, VISA, Cabal, Diners, Naranja,
                            Credimás.</br>
                            Tarjetas de débito: Visa Débito y Cabal Débito.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">¿Cuales son los horarios en de delivery?</button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Desde las 11:00 hasta las 02:00hs
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">¿Cuanto tarda en llegar mi pedido?</button>
                        </h2>
                    </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Entre 40 y 60 minutos.
                        </div>
                </div>
            </div>
        </div>
    </p>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:templates/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
