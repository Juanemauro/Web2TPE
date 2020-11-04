{include 'templates/Acceso/header.tpl'}
    <div class="slide">
        <form method= "POST" action="registrarse" class="form" >
            <div class="form-group">
                <label for="username">Ingrese su Alias para registrarse</label>
                <input type="username" class="form-control" name="username" id="username"  placeholder="Alias">
            </div>
            <div class="form-group">
                <label for="pregunta">Ingrese su pregunta secreta para más seguridad</label>
                <input type="username" class="form-control" name="pregunta" id="pregunta"  placeholder="Pregunta secreta">
            </div>
            <div class="form-group">
                <label for="respuesta">Ingrese la respuesta</label>
                <input type="username" class="form-control" name="respuesta" id="respuesta"  placeholder="Respuesta secreta">
            </div>
            <div  class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        {if $aviso != ''}
            <div class="alert alert-danger" role="alert">
                {$aviso}
            </div>
        {/if}
</div>
{include 'templates/Acceso/footer.tpl'}