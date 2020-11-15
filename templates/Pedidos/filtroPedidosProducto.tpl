<form method= "GET" action="showFiltroPedidos" class="form">
    <label for="inputName4">Filtrar pedidos: </label>
    <select class="form-control" name="nombreProductoParaFiltrar" id="nombreProductoParaFiltrar">
        <option value="" selected>Elegir...</option>
            {foreach from=$productos item=producto}
                <option value="{$producto->nombre}"> {$producto->nombre}</option>
            {/foreach}            
    </select>
    <button type="submit" class="btn btn-primary" id="filtrarPedidos">Filtrar</button>
</form>
