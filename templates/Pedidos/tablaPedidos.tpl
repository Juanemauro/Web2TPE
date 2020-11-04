<table class="pedidos_tabla">
    <thead>
        <td>Cliente</td>
        <td>Producto</td>    
        <td>Dirección</td>
        <td>Detalle</td>
    </thead>
    {foreach  from=$pedidos item=pedido}
        <tr>
            <td>{$pedido->cliente}</td>
            <td>{$pedido->nombre}</td>
            <td>{$pedido->direccion}</td>
            <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-info">Detalle</a></td>
        </tr>
    {/foreach}
</table>
