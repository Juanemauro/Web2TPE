{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
            <tr>
                <td>Cliente</td>
                <td>Producto</td>    
                <td>Dirección</td>
                <td>Detalle</td>
            </tr>
            {foreach  from=$pedidos item=$pedido}
                <tr>
                    <td>{$pedido->cliente}</td>
                    <td>{$pedido->nombre}</td>
                    <td>{$pedido->direccion}</td>
                    <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-info">Detalle</a></td>
                </tr>
            {/foreach}            
    </table>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
</div>
{include 'templates/Acceso/footer.tpl'}
