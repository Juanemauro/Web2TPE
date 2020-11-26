{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <form method= "POST" action="addPedido" class="form" enctype="multipart/form-data">
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
                {foreach from=$productos item=producto}
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
        {* CAPTCHA QUE GENERA ERROR JS
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
                <label for="button-captcha" class="text-white">a</label>
                <button type="button" class="btn btn-primary" id="actucaptcha">Actualizar</button>
                </div>
                </label>
            </div>
        </div>*}
        {* AGREGAR IMAGEN DESDE PEDIDO ADMIN, VA O NO VA?}
        {if $admin}
            <div>
                <label for="inputCantidad">Agregar imágenes al pedido</label>
                <input type="file" REQUIRED name="image[]" multiple>        
                <input type="hidden" name="id_pedido" value="{$id_pedido}">
            </div>
        {/if}
        *}
        {if $admin}
            <div>
                <label>Agregar imágenes</label>
                <input type="file" name="image[]" multiple>
            </div>
            <div>
                <label>Descripción de la/s imágenes</label>
                <input name="descripcion" value="">
            </div> 
        {/if}
        <button type="submit" class="btn btn-primary" id="realizpedido">Realizar pedido</button>
    </form>    
    {include 'templates/Pedidos/tablaPedidos.tpl'}
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
</div>
{*<script src="js/main.js"></script>No lo necesito para esta materia*}    
{include 'templates/Acceso/footer.tpl'}