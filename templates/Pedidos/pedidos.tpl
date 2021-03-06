{include 'templates/Acceso/header.tpl'}
<div class="slide">
    {if $admin == true}
        {include 'templates/Pedidos/pedidosAdmin.tpl'}  
    {else} 
        {if ($loggeado == true)}
            {include 'templates/Pedidos/pedidosLoggeado.tpl'}  
        {/if}
    {/if}
    {include 'templates/Pedidos/filtroPedidosProducto.tpl'}
    {include 'templates/Pedidos/formBusquedaAvanzada.tpl'}
    {include 'templates/Pedidos/formCantPedidosPaginacion.tpl'}     
        {if {$pagina} eq 0}
            <h1>No existen pedidos con esos datos</h1>            
        {else}
            {include 'templates/Pedidos/tablaPedidos.tpl'}
            <div> 
                <p>_ </p>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {*anterior*}
                    {if {$pagina} <= 1 }
                        <li class="page-item disabled">  
                    {else if}
                        <li class="page-item">
                    {/if}  
                        <a class="page-link" href="Pedidos?pagina={$pagina-1}&items={$pedidos_por_pagina}&usuario={$usuarioBusqueda}&producto={$producto}&estado={$estado}">Página anterior</a>
                    </li>
                    {*cantidad de páginas*}
                    {for $i=1 to $cant_paginas}
                        {if {$pagina} == {$i}}
                            <li class="page-item active">
                        {else if}
                            <li class="page-item">
                        {/if}
                            <a class="page-link" href="Pedidos?pagina={$i}&items={$pedidos_por_pagina}&usuario={$usuarioBusqueda}&producto={$producto}&estado={$estado}">{$i}</a>
                        </li>
                    {/for}
                    {*siguiente*}  
                    {if {$pagina} eq {$cant_paginas}}
                        <li class="page-item disabled">  
                    {else if}
                        <li class="page-item">
                    {/if}                       
                        <a class="page-link" href="Pedidos?pagina={$pagina+1}&items={$pedidos_por_pagina}&usuario={$usuarioBusqueda}&producto={$producto}&estado={$estado}">Página siguiente</a>
                    </li>
                </ul>
            </nav>
        {/if}
    {*{/if}*}
</div>
{include 'templates/Acceso/footer.tpl'}
