<a href="newPedido" class="btn btn-success btn-lg btn-block">Agregar Pedido</a>
{if !empty($pedidos)}
    <a href="menuEditPedido" class="btn btn-success btn-lg btn-block">Editar Pedido</a>
    <a href="menuDeletePedido" class="btn btn-success btn-lg btn-block">Borrar Pedido</a>
{/if}
{include 'templates/Pedidos/filtroPedidosProducto.tpl'}
{include 'templates/Pedidos/formBusquedaAvanzada.tpl'}
{include 'templates/Pedidos/formCantPedidosPaginacion.tpl'}
