 {if $pedidos_por_pagina <= $cant_pedidos}
    <div class="form-group">
        <form method= "GET" action="Pedidos" class="form">
            <label for="inputPedido">Pedidos por página</label>
            <select class="form-control" name="items">
            <option value="{$pedidos_por_pagina}" selected>{$pedidos_por_pagina}</option>
                {if 5 <= $cant_pedidos}<option value="5">5</option>{/if}
                {if 10 <= $cant_pedidos}<option value="10">10</option>{/if}  
                {if 15 <= $cant_pedidos}<option value="15">15</option>{/if}  
            </select>
            <button type="submit" class="btn btn-primary" id="realizpedido">Recargar</button>
        </form>
    </div>
{/if}