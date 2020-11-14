{include 'templates/Acceso/header.tpl'}
<input name="id_pedido" type="hidden" value="{$pedido->id_pedido}">
    {if $admin == true}
        <input id="admin" type="hidden" value="true"> {*Para obtener el valor de admin*}
    {else}
        <input id="admin" type="hidden" value="false"> {*Para obtener el valor de admin*}
    {/if}
<div class="slide">
        {*tabla*}
        <div>
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
        </div>
        <a href="Pedidos" class="btn btn-info">Volver a Pedidos</a>
        <a href="verImagenes/{$pedido->id_pedido}" class="btn btn-success">Ver imágenes del pedido</a>
        {*comentarios*}
        <div>
            {include 'vue/comentarios.tpl'}            
        </div>  
        {*form add comentario*}
        <div>      
            {if $loggeado == true or $admin == true}                
                    <form id="form-comentario" method="POST">
                        <div class="form-group shadow-textarea">
                            <h3>Tu opinión nos interesa..</h3>
                            <textarea class="form-control z-depth-1" name="texto" rows="4" cols="12" placeholder="Dejanos aquí tu comentario.."></textarea>                        
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
            {/if} 
        </div>  
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> {*Sólo lo trae cuando navego esta página*}
<script src="js/comments.js"></script> {*Sólo lo trae cuando navego esta página*}
{include 'templates/Acceso/footer.tpl'}