{include 'templates/Acceso/header.tpl'}
    <div class="slide">
        <form method= "POST" action="updatePassword" class="form" >
            <h3>Hola, {$alias}!</h3>
            <div class="form-group">
                <label for="usuario">Usuario </label>
                <input type="usuario" class="form-control" name="usuario" id="usuario" value="{$alias}" placeholder="{$alias}">
            </div>
            <div class="form-group">
                <label for="password1">Ingrese nueva contraseña</label>
                <input type="password" class="form-control" name="password1" id="password1"  >
            </div>
            <div class="form-group">
                <label for="password2">Ingrese nuevamente la contraseña</label>
                <input type="password" class="form-control" name="password2" id="password2" >
            </div>
            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
        </form>
        {if $error != ''}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/if}
</div>
{include 'templates/Acceso/footer.tpl'}