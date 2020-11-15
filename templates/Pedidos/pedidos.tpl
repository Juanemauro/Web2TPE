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
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {*anterior*}
             {if {$pagina} eq 1 }
                <li class="page-item disabled">  
            {else if}
                <li class="page-item">
            {/if}  
                <a class="page-link" href="Pedidos?pagina={$pagina-1}">Página anterior</a>
            </li>
            {*cantidad de páginas*}
            {for $i=1 to $cant_paginas}
                {if {$pagina} == {$i}}
                    <li class="page-item active">
                {else if}
                    <li class="page-item">
                {/if}
                    <a class="page-link" href="Pedidos?pagina={$i}">{$i}</a>
                </li>
            {/for}
            {*siguiente*}  
            {if {$pagina} eq {$cant_paginas}}
                <li class="page-item disabled">  
            {else if}
                <li class="page-item">
            {/if}                       
                <a class="page-link" href="Pedidos?pagina={$pagina+1}">Página siguiente</a>
            </li>
        </ul>
    </nav>
</div>
{include 'templates/Acceso/footer.tpl'}
