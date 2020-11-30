{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <h1>ERROR!</h1>
    <h2>{$mensajeError}</h2>
    {foreach from=$errorImagenes item=imagen}
        <ul>
            <li class="list-group-item list-group-item-warning">{$imagen}</li>
        </ul>    
    {/foreach}
    <h3>Recuerda que el formato de las imágenes deben ser JPG, JPEG, PNG o GIF.</h3>
    <a href={$redireccion1} class="btn btn-info">Volver a {$seccion1}</a>
    <a href={$redireccion2} class="btn btn-success">Volver a {$seccion2}</a>
</div>
{include 'templates/Acceso/footer.tpl'}