{if $loggeado == true}
    {include 'templates/headerLoggeado.tpl'}
{else}
    {include 'templates/headerPublico.tpl'}
{/if}
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
            {if $pedido->entregado eq 0}{* si el campo entregado tiene un 0 -> no está entregado*}
                <td>Aun no entregado</td>
                {else} {* si el campo entregado tiene algo distinto a 0 (1, porque es entregado es boolean) -> no está entregado*}
                <td>Entregado</td>
            {/if}
        </tr>
    </table>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
</div>
{include 'templates/footer.tpl'}