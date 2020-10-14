{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <h1>ERROR!</h1>
    <h2>{$mensajeError}</h2>
    <a href={$redireccion} class="btn btn-info">Volver a {$seccion}</a>
</div>
{include 'templates/Acceso/footer.tpl'}