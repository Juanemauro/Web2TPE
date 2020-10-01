{include 'templates/header.tpl'}
<div class="slide">
    <form class="form-group" method= "GET" action="refreshPedido" >
        <div class="form-group">
            <label for="nombrePedidoEditado">Nombre:</label>
            <input type="text" class="form-control" name="nombrePedidoEditado" id="nombrePedidoEditado" value="{$pedidos->cliente}">
        </div>
        <div>
            <label for="direccionPedidoEditado">Dirección:</label>
            <input type="text" class="form-control" name="direccionPedidoEditado" id="direccionPedidoEditado" value="{$pedidos->direccion}">
        </div>
        {*<div>
            <label for="nombreProductoDelPedidoEdtiado">Producto:</label>
            <input type="text" class="form-control" name="nombreProductoDelPedidoEdtiado" id="nombreProductoDelPedidoEdtiado" value="{$pedido->nombre}">
        </div>*}        
        <div>
            <label for="idProductoEditado">Producto</label>
            <select class="form-control" name="idProductoEditado" id="idProductoEditado">
            <option value="" selected>Elegir..</option>
                {foreach from=$productos item=$producto}
                    <option value="{$producto->id_producto}"> {$producto->nombre}</option>
                {/foreach}            
            </select>
        </div>
        <div>
            <label for="cantidadPedidoEditado">Cantidad:</label>
            <input type="number" class="form-control" name="cantidadPedidoEditado" id="cantidadPedidoEditado" value="{$pedidos->cantidad}">
        </div class="form-group">
            <div>
            <label for="entregadoPedidoEditado">Estado:</label>
                <input type="number" class="form-control" name="entregadoPedidoEditado" id="entregadoPedidoEditado" value="{$pedidos->entregado}">
                <input type="text" class="d-none" name="idPedidoEditado" id="idPedidoEditado" value="{$id}">
            </div>
        <button type="submit" class="btn btn-primary">Editar Pedido</button> 
    </form>
 </div>
{include 'templates/footer.tpl'}