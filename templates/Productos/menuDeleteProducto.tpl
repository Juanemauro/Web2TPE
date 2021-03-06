{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <thead>
            <td>
                <form>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="showOrderedProductosByNameAsc">Nombre ▲</a>
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
            <td> Producto a borrar</td> 
        </thead>
        {foreach  from=$productos item=producto}
            <tr>
                <td>{$producto->nombre}</td>                    
                <td>{$producto->descripcion}</td>
                <td>{$producto->precio}</td>
                <td><a href="deleteProducto/{$producto->id_producto}" class="btn btn-info">Borrar</a></td>
            </tr>
        {/foreach}
    </table>
    <a href="Productos" class="btn btn-info">Volver a Productos</a>
</div>
{include 'templates/Acceso/footer.tpl'}