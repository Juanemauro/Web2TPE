{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <thead>
            <td>Usuario</td>
            <td>Recibió</td>
            <td>Producto</td>    
            <td>Dirección</td>
            <td>Estado</td>
            <td>Detalle</td>
        </thead>
        {foreach  from=$pedidos item=pedido}
            <tr>
                <td>{$pedido->alias}</td>
                <td>{$pedido->cliente}</td>
                <td>{$pedido->nombre}</td>
                <td>{$pedido->direccion}</td>
                <td>{$pedido->estado}</td>
                <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-info">Detalle</a></td>
            </tr>
        {/foreach}
    </table>
{if ($admin == true or $loggeado == true)}
    <a href="{$pagina_anterior}"type="submit" class="btn btn-warning">Volver a Búsqueda Avanzada</a>
{/if}
</div>
{include 'templates/Acceso/footer.tpl'}
