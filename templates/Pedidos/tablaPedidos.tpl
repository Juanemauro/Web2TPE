<table class="pedidos_tabla">
    <thead>
        <td>id pedido</td>
        <td>Usuario</td>
        <td>Recibió</td>
        <td>Producto</td>    
        <td>Dirección</td>
        <td>Estado</td>
        <td>Detalle</td>
    </thead>
    {foreach  from=$pedidos item=pedido}
        <tr>
            <td>{$pedido->id_pedido}</td>
            <td>{$pedido->alias}</td>            
            <td>{$pedido->cliente}</td>
            <td>{$pedido->nombre}</td>
            <td>{$pedido->direccion}</td>
            <td>{$pedido->estado}</td>
            <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-info">Detalle</a></td>
        </tr>
    {/foreach}
</table>
