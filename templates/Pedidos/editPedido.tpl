{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <form class="form-group" method= "POST" action="refreshPedido" enctype="multipart/form-data">
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
            <option value="{$pedidos->id_producto}" selected>{$pedidos->nombre}</option>
                {foreach from=$productos item=producto}
                    <option value="{$producto->id_producto}"> {$producto->nombre}</option>
                {/foreach}            
            </select>
        </div>
        <div>
            <label for="cantidadPedidoEditado">Cantidad:</label>
            <input type="number" class="form-control" name="cantidadPedidoEditado" id="cantidadPedidoEditado" value="{$pedidos->cantidad}">
        </div class="form-group">
            <div>
            <label for="estadoPedidoEditado">Estado:</label>
                <select class="form-control" name="estadoPedidoEditado" id="estadoPedidoEditado">
                <option value="{$pedidos->estado}" selected>{$pedidos->estado}</option>
                    <option value="Entregado">Entregado</option>
                    <option value="En preparación">En preparación</option>
                    <option value="En camino">En camino</option>
                </select>
                <input type="text" class="d-none" name="idPedidoEditado" id="idPedidoEditado" value="{$id}">
            </div>
            <div>
                <label>Agregar imágenes</label>
                <input type="file" REQUIRED name="image[]" multiple>
                <input type="hidden" name="id_pedido" value="{$id_pedido}">
            </div> 
        <button type="submit" class="btn btn-primary">Editar Pedido</button> 
    </form>
    {*Eliminar imágenes del pedido*}
    <h2>Eliminar imágenes del pedido</h2>
    <table class="pedidos_tabla">
        <thead>
            <td>Imagen</td>
            {if $admin}   
                <td>Eliminar</td>
            {/if}
        </thead>
        {foreach from=$imagenes item=imagen}
            <tr>
                <td><img src="{$imagen->ruta}" width="200px" height="250px"></td>
                
                {if $admin}   
                    <td><a href="eliminarImagen/{$imagen->id_imagen}" class="btn btn-danger">Eliminar</a></td>
                {/if}
            </tr>         
        {/foreach}
        
    </table>
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
 </div>
{include 'templates/Acceso/footer.tpl'}