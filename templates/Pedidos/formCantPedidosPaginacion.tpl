 <div class="form-group">
    <form method= "GET" action="Pedidos" class="form">
        <label for="inputPedido">Pedidos por página</label>
        <select class="form-control" name="items">
        <option value="{$pedidos_por_pagina}" selected>{$pedidos_por_pagina}</option>
            <option value="5">5</option>
            <option value="10">10</option>     
            <option value="15">15</option>  
        </select>
        <button type="submit" class="btn btn-primary" id="realizpedido">Recargar</button>
    </form>
</div>