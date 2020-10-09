<a href="newPedido" class="btn btn-success btn-lg btn-block">Agregar Pedido</a>
<a href="menuEditPedido" class="btn btn-success btn-lg btn-block">Editar Pedido</a>
<a href="menuDeletePedido" class="btn btn-success btn-lg btn-block">Borrar Pedido</a>
{include 'templates/Pedidos/filtroPedidos.tpl'}
<table class="pedidos_tabla">
    <thead>
        <td><form>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cliente</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="Pedidos">Cliente ▲</a>
                        <a class="dropdown-item" href="showOrderedPedidosByClienteDesc">Cliente ▼</a>
                    </div>
                </div>
            </form>
        </td>
        <td>
            <form>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Producto</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="showOrderedPedidosByProductoAsc">Producto ▲</a>
                        <a class="dropdown-item" href="showOrderedPedidosByProductoDesc">Producto ▼</a>
                    </div>
                </div>
            </form>
        </td>    
        <td>Dirección</td>
        <td>Detalle</td>
    </thead>
    {foreach  from=$pedidos item=$pedido}
        <tr>
            <td>{$pedido->cliente}</td>
            <td>{$pedido->nombre}</td>
            <td>{$pedido->direccion}</td>
            <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-info">Detalle</a></td>
        </tr>
    {/foreach}
</table>  


