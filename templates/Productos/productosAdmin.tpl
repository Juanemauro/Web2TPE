<a href="newProducto" class="btn btn-success btn-lg btn-block">Agregar Producto</a>
<a href="menuEditProducto" class="btn btn-success btn-lg btn-block">Editar Producto</a>
<a href="menuDeleteProducto" class="btn btn-success btn-lg btn-block">Borrar Producto</a>
<div> 
    <p>_ </p>
</div>
<table class="pedidos_tabla">
    <thead>
        <td>Producto</td>
        <td>Descripcion</td>
        <td>Precio</td> 
    </thead>
    {foreach from=$productos item=producto}
        <tr>
            <td>{$producto->nombre}</td>                    
            <td>{$producto->descripcion}</td>
            <td>{$producto->precio}</td>
        </tr>
    {/foreach}
</table>

