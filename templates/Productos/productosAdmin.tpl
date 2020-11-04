<a href="newProducto" class="btn btn-success btn-lg btn-block">Agregar Producto</a>
<a href="menuEditProducto" class="btn btn-success btn-lg btn-block">Editar Producto</a>
<a href="menuDeleteProducto" class="btn btn-success btn-lg btn-block">Borrar Producto</a>
<table class="pedidos_tabla">
    <thead>
        <td>
            <form>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="Productos">Nombre ▲</a>
                        <a class="dropdown-item" href="showOrderedProductosByNameDesc">Nombre ▼</a>
                    </div>
                </div>
            </form>
        </td> 
        <td>Descripcion</td>
        <td>
            <form>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precio</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="showOrderedProductosByPriceAsc">Precio ▲ </a>
                        <a class="dropdown-item" href="showOrderedProductosByPriceDesc">Precio ▼</a>
                    </div>
                </div>
            </form>
        </td> 
    </thead>
    {foreach from=$productos item=producto}
        <tr>
            <td>{$producto->nombre}</td>                    
            <td>{$producto->descripcion}</td>
            <td>{$producto->precio}</td>
        </tr>
    {/foreach}
</table>

