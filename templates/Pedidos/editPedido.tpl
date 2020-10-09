{if $loggeado == true}
    {include 'templates/Acceso/headerLoggeado.tpl'}
{else}
    {include 'templates/Acceso/headerPublico.tpl'}
{/if}
<div class="slide">
    <form class="form-group" method= "POST" action="refreshPedido" >
        <div class="form-group">
            <label for="nombrePedidoEditado">Nombre:</label>
            <input type="text" class="form-control" name="nombrePedidoEditado" id="nombrePedidoEditado" value="{$pedidos->cliente}">
        </div>
        <div>
            <label for="direccionPedidoEditado">Dirección:</label>
            <input type="text" class="form-control" name="direccionPedidoEditado" id="direccionPedidoEditado" value="{$pedidos->direccion}">
        </div>        
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
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
 </div>
{include 'templates/Acceso/footer.tpl'}