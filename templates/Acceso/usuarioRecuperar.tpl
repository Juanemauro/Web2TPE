{include 'templates/Acceso/header.tpl'}
    <div class="slide">
        <form method= "POST" action="verificarUsuario" class="form" >
            <div class="form-group">
                <label for="username">Ingrese su Alias</label>
                <input type="username" class="form-control" name="username" id="username"  placeholder="Alias">
            </div>
            <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
        </form>
        {if $error != ''}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/if}
</div>
{include 'templates/Acceso/footer.tpl'}