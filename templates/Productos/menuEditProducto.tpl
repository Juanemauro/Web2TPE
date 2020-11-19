{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <table class="pedidos_tabla">
        <thead>
            <td>Producto</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Editar</td>  
        </thead>
        {foreach from=$productos item=producto}
            <tr>
                <td>{$producto->nombre}</td>                    
                <td>{$producto->descripcion}</td>
                <td>{$producto->precio}</td>
                <td><a href="editProducto/{$producto->id_producto}" class="btn btn-info">Editar</a></td>
            </tr>
        {/foreach}
    </table>
    <a href="Productos" class="btn btn-info">Volver a Productos</a>
</div>
{include 'templates/Acceso/footer.tpl'}   