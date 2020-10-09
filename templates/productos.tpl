{if $loggeado == true}
    {include 'templates/headerLoggeado.tpl'}
{else}
    {include 'templates/headerPublico.tpl'}
{/if}
<div class="slide">
    {if $loggeado == true}
        {include 'templates/productosAdmin.tpl'}
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
{include 'templates/footer.tpl'}