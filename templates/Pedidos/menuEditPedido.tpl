{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <thead>
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
            <td>Pedido a editar</td> 
        </thead>
        {foreach  from=$pedidos item=pedido}
            <tr>
                <td>{$pedido->cliente}</td>
                <td>{$pedido->nombre}</td>
                <td>{$pedido->direccion}</td>
                <td><a href="editPedido/{$pedido->id_pedido}" class="btn btn-info">Editar</a></td>
            </tr>
        {/foreach}
    </table>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
</div>
{include 'templates/Acceso/footer.tpl'}
