{include 'templates/header.tpl'}
<div class="slide">
    <p>
    <form class="form-group" method= "POST" action="addProducto" >
        <div class="form-group">
            <label for="nombreProductoEditado">Nombre:</label>
            <input type="text" class="form-control" name="nombreProductoNuevo" id="nombreProductoNuevo">
        </div>
        <div>
            <label for="descripcionProductoEditado">Descripcion:</label>
            <input type="text" class="form-control" name="descripcionProductoNuevo" id="descripcionProductoNuevo">
        </div>
        <div>
            <label for="precioProductoEditado">Precio:</label>
            <input type="number" class="form-control" name="precioProductoNuevo" id="precioProductoNuevo">
            <input type="text" class="d-none" name="idProductoNuevo" id="idProductoNuevo" value="{$id}">

        </div class="form-group">
        <button type="submit" class="btn btn-primary">Agregar Producto</button> 
    </form>
    </p>
    <table class="pedidos_tabla">
        <tr>
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
        </tr>
        {foreach from=$productos item=$producto}
            <tr>
                <td>{$producto->nombre}</td>                    
                <td>{$producto->descripcion}</td>
                <td>{$producto->precio}</td>
            </tr>
        {/foreach}
    </table>
</div>
{include 'templates/footer.tpl'}   