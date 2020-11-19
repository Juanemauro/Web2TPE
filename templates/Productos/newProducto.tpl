{include 'templates/Acceso/header.tpl'}
<div class="slide">
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
    <a href="Productos" class="btn btn-info">Volver a Productos</a>
</div>
{include 'templates/Acceso/footer.tpl'}   