{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <tr>
            <td>Cliente</td>
            <td>Producto</td>
                <td>Dirección</td>
                <td>Cantidad</td>
                <td>Estado</td>
            </tr>
        <tr>
            <td>{$pedido->cliente}</td>
            <td>{$pedido->nombre}</td>
            <td>{$pedido->direccion}</td>
            <td>{$pedido->cantidad}</td>
            <td>{$pedido->estado}</td>
        </tr>
    </table>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
</div>
{include 'templates/Acceso/footer.tpl'}