{include 'templates/Acceso/header.tpl'}
<div class="slide">
    {*carousel*}
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            {foreach from=$imagenes item=imagen name=contador} {*contador dentro del foreach*}
                {if ($smarty.foreach.contador.index) == 0}
                    <div class="carousel-item active">
                        <img src="{BASE_URL}{$imagen->ruta}" alt="{$imagen->id_imagen}" height="500px" class="d-block w-100">
                    </div>
                {else}
                    <div class="carousel-item">
                        <img src="{BASE_URL}{$imagen->ruta}" alt="{$imagen->id_imagen}" height="500px" class="d-block w-100">
                    </div>
                {/if}
            {/foreach}
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {*add imagen*}
    {if $admin}   
         <form action="agregarImagenes" method="POST" enctype="multipart/form-data">
            {*<label>Agregar una imagen</label>*}
            <input type="file" REQUIRED name="image[]" multiple>
            <input type="hidden" name="id_pedido" value="{$id_pedido}">
            <div>
                <label>Descripción de la/s imágenes</label>
                <input name="descripcion" value="">
            </div>
            <button type="submit" class="btn btn-success">Agregar imagen</button>
        </form>
    {/if}
    {*detalle de cada imagen + botón eliminar imagen*}
    <table class="pedidos_tabla">
        <thead>
            <td>Imagen</td>
            <td>Descripción</td> 
            {if $admin}   
                <td>Eliminar</td>
            {/if}
        </thead>
        {foreach from=$imagenes item=imagen}
            <tr>
                <td><img src="{$imagen->ruta}" width="200px" height="250px"></td>
                <td>{$imagen->descripcion}</td>
                {if $admin}   
                    <td><a href="eliminarImagen/{$imagen->id_imagen}" class="btn btn-danger">Eliminar</a></td>
                {/if}
            </tr>
        {/foreach}
    </table>
</div>
{include 'templates/Acceso/footer.tpl'}