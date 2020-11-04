{include 'templates/Acceso/header.tpl'}
<div class="slide">
    <form action="verificarUser" method="post">
        <div class="form-group">
            <label for="user">Alias</label>
            <input class="form-control" id="alias" name="alias" aria-describedby="emailHelp" placeholder="Alias">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
        {if $aviso != ''}
            <div class="alert alert-danger" role="alert">
                {$aviso}
            </div>
        {/if}

</div>
{include 'templates/Acceso/footer.tpl'}