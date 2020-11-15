{include 'templates/Acceso/header.tpl'}
<div class="slide">
    {if $admin == true}
        {include 'templates/Pedidos/pedidosAdmin.tpl'}    
    {else}        
        {if $loggeado == true}
            {include 'templates/Pedidos/pedidosLoggeado.tpl'}
            {include 'templates/Pedidos/filtroPedidosProducto.tpl'}
            {include 'templates/Pedidos/tablaPedidos.tpl'}
        {else}
            {include 'templates/Pedidos/filtroPedidosProducto.tpl'}
            {include 'templates/Pedidos/tablaPedidos.tpl'}
        {/if}
    {/if}
</div>
{include 'templates/Acceso/footer.tpl'}
