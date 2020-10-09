{if $loggeado == true}
    {include 'templates/Acceso/headerLoggeado.tpl'}
{else}
    {include 'templates/Acceso/headerPublico.tpl'}
{/if}
<div class="slide">
    {if $loggeado == true}
        {include 'templates/Productos/productosAdmin.tpl'}
    {else}
        <table class="pedidos_tabla">
            <thead>
                <td>Nombre</td> 
                <td>Descripcion</td>
                <td>Precio</td> 
            </thead>
            {foreach from=$productos item=$producto}
                <tr>
                    <td>{$producto->nombre}</td>                    
                    <td>{$producto->descripcion}</td>
                    <td>{$producto->precio}</td>
                </tr>
            {/foreach}
        </table>
    {/if}
</div>    
{include 'templates/Acceso/footer.tpl'}