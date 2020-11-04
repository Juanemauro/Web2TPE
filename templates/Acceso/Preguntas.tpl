{include 'templates/Acceso/header.tpl'}
    <div class="slide">
        <form method= "POST" action="verificarPregunta" class="form" >
            <h3>Hola, {$usuario}!</h3>
            <div class="form-group">
                <label for="pregunta">Usuario </label>
                <input type="pregunta" class="form-control" name="usuario" id="usuario" value="{$usuario}" placeholder="{$usuario}">
            </div>
            <div class="form-group">
                <label for="pregunta">Ingrese su pregunta secreta</label>
                <input type="pregunta" class="form-control" name="pregunta" id="pregunta"  placeholder="Pregunta secreta">
            </div>
            <div class="form-group">
                <label for="respuesta">Ingrese la respuesta</label>
                <input type="respuesta" class="form-control" name="respuesta" id="respuesta"  placeholder="Respuesta">
            </div>
            <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
        </form>
        {if $aviso != ''}
            <div class="alert alert-danger" role="alert">
                {$aviso}
            </div>
        {/if}
</div>
{include 'templates/Acceso/footer.tpl'}