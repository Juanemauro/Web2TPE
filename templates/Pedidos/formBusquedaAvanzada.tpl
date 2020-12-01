<div class="slide">
    <form method= "GET" action="Pedidos" class="form">
        <h2>Búsqueda avanzada</h2>
        <label for="inputName4">Elija un usuario </label> {* filtro de la primera entrega*}
        <select class="form-control" name="usuario" id="usuario">
            <option value="" selected>Elegir...</option>
                <option value="Todos">Todos</option>
                {foreach from=$usuarios item=usuario}
                    <option value="{$usuario->id_usuario}"> {$usuario->alias}</option>
                {/foreach}            
        </select>
        <label for="inputName4">Elija un producto:</label>
        <select class="form-control" name="producto" id="nombreProductoParaFiltrar">
            <option value="" selected>Elegir...</option>
                <option value="Todos">Todos</option>
                {foreach from=$productos item=producto}
                    <option value="{$producto->id_producto}"> {$producto->nombre}</option>
                {/foreach}            
        </select>
        <label for="inputName4">Elija un estado del pedido:</label>
        <select class="form-control" name="estado">
                <option value="" selected>Elegir..</option>
                    <option value="Todos">Todos</option>
                    <option value="Entregado">Entregado</option>
                    <option value="En preparación">En preparación</option>
                    <option value="En camino">En camino</option>
                </select>
        <button type="submit" class="btn btn-warning">Realizar búsqueda avanzada</button>
    </form>
</div>
