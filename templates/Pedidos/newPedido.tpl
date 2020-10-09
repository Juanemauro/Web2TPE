{if $loggeado == true}
    {include 'templates/Acceso/headerLoggeado.tpl'}
{else}
    {include 'templates/Acceso/headerPublico.tpl'}
{/if}
<div class="slide">
    <form method= "POST" action="addPedido" class="form">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName4">Nombre</label>
                <input type="name" class="form-control" name="inputName" id="inputName" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastname4">Apellido</label>
                <input type="lastname" class="form-control" name="inputLastname" id="inputLastname" placeholder="Apellido">
            </div>
        </div>
        <div class="form-row">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" name="inputAddress"  id="inputAddress" placeholder="Calle XXXX DPTO XXXX">
        </div>
        <div class="form-group">
            <label for="inputPedido">Producto</label>
            <select class="form-control" name="inputPedido" id="inputPedido">
            <option value="" selected>Elegir...</option>
                {foreach from=$productos item=$producto}
                    <option value="{$producto->id_producto}"> {$producto->nombre}</option>
                {/foreach}            
            </select>
        </div>
        <div>
            <div class="form-group">
                <label for="inputCantidad">Cantidad</label>
                <input type="number" class="form-control" name="inputCantidad" id="inputCantidad" max="24" placeholder="1">
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="captcha">Captcha:</label>
                <input type="text" id="inputText" class="form-control">
                </div>
                <div class="form-group col-md-4">
                <label for="generatedcaptcha" class="text-white">a</label>
                <input type="text" class="form-control" id="captcha" disabled />
                </div>
                <div class="form-group col-md-4">
                <label for="button-captcha" class="text-white">a</label></br>
                <button type="button" class="btn btn-primary" id="actucaptcha">Actualizar</button>
                </div>
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="realizpedido">Realizar pedido</button>
    </form>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
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
                <td><a href="detailPedido/{$pedido->id_pedido}" class="btn btn-primary">Detalle</a></td>
            </tr>
        {/foreach}
    </table>
</div>    
{include 'templates/Acceso/footer.tpl'}
