{include 'templates/Acceso/header.tpl'}
<div class="slide">
    {if $admin == true}
        {include 'templates/Productos/productosAdmin.tpl'}
    {else}
        <table class="pedidos_tabla">
            <thead>
                <td>Nombre</td> 
                <td>Descripcion</td>
                <td>Precio</td> 
            </thead>
            {foreach from=$productos item=producto}
                <tr>
                    <td>{$producto->nombre}</td>                    
                    <td>{$producto->descripcion}</td>
                    <td>{$producto->precio}</td>
                </tr>
            {/foreach}
        </table>
    {/if}
    {if $mensaje != ''}
            <div class="alert alert-danger" role="alert">
                {$mensaje}
            </div>
     {/if}
</div>    
{include 'templates/Acceso/footer.tpl'}