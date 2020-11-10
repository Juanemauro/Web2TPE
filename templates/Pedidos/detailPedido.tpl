{include 'templates/Acceso/header.tpl'}
<input name="id_pedido" type="hidden" value="{$pedido->id_pedido}">
   {if $admin == true}
        <input id="admin" type="hidden" value="true"> {*Para obtener el valor de admin*}
    {else}
        <input id="admin" type="hidden" value="false"> {*Para obtener el valor de admin*}
    {/if}
<div class="slide">
    <table class="pedidos_tabla">
        <thead>
            <td>Cliente</td>
            <td>Producto</td>
            <td>Dirección</td>
            <td>Cantidad</td>
            <td>Estado</td>
            </tr>
        </thead>
        <tr>
            <td>{$pedido->cliente}</td>
            <td>{$pedido->nombre}</td>
            <td>{$pedido->direccion}</td>
            <td>{$pedido->cantidad}</td>
            <td>{$pedido->estado}</td>
        </tr>
    </table>    
    <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>  
    {if $admin == true}        
        <form action="{BASE_URL}agregarImagen" method="POST" enctype="multipart/form-data">
            {*<label>Agregar una imagen</label>*}
            <input type="file" REQUIRED name="image[]">
            <input type="text" hidden name="id_pedido" value="{$pedido->id_pedido}">
            <button type="submit" class="btn btn-success">Agregar imagen</button>
        </form>
    {/if}   
    {*<div class="container">
        <div class="row">
            <div class="col-12">
                <table class="pedidos_tabla">
                    <thead>
                        <tr>
                            <td>Imágenes</td>
                            <th>Eliminar imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$imagenes item=imagen}
                            <tr>
                                {if ($pedido->id_pedido) == ($imagen->id_pedido)}
                                    <td width="400px"><img src="{BASE_URL}{$imagen->ruta}"></td>
                                {/if}                   
                                <td><a href="{BASE_URL}borrarImagen/{$imagen->id_imagen}/{$pedido->id_pedido}">Eliminar</td>
                            </tr>
                        {/foreach} 
                    </tbody>
                </table>   
            </div>
        </div>
    </div>*}
    {if $loggeado == true or $admin == true}
        <div>
            <form id="form-comentario" method="POST">
                <div class="form-group shadow-textarea">
                    <label for="exampleFormControlTextarea6">Tu opinión nos interesa..</label>
                    <textarea class="form-control z-depth-1" name="texto" rows="3" placeholder="Dejanos aquí tu comentario.."></textarea>                        
                </div>
                <h6>Puntaje:  
                <select id="puntaje" class="form-control">
                        <option value="1" name="puntos">1</option>
                        <option value="2" name="puntos">2</option>
                        <option value="3" name="puntos">3</option>
                        <option value="4" name="puntos">4</option>
                        <option value="5" name="puntos">5</option>
                </select>
                </h6>
                <input name="id_usuario" type="hidden" value="{$id_usuario}">
                <button type="submit" class="btn btn-primary">Agregar comentario</button>
            </form>               
        </div>
    {/if}    
</div>
{include 'vue/comentarios.tpl'}
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> {*Sólo lo trae cuando navego esta página*}
<script src="js/comments.js"></script> {*Sólo lo trae cuando navego esta página*}
{include 'templates/Acceso/footer.tpl'}