{include 'templates/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <tr>
            <td><form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cliente</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedPedidosByClienteAsc">Cliente ▲</a>
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
        </tr>
        {foreach  from=$pedidos item=$pedido}
            <tr>
                <td>{$pedido->cliente}</td>
                <td>{$pedido->nombre}</td>
                <td>{$pedido->direccion}</td>
                <td><a href="deletePedido/{$pedido->id_pedido}" class="btn btn-info">Borrar</a></td>
            </tr>
        {/foreach}
    </table>
</div>
{include 'templates/footer.tpl'}