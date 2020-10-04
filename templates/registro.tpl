{include 'templates/header.tpl'}
    <div class="slide">
        <form method= "POST" action="registrarse" class="form" >
            <div class="form-group">
                <label for="username">Alias</label>
                <input type="username" class="form-control" name="username" id="username"  placeholder="Alias">
            </div>
            <div  class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
</div>
{include 'templates/footer.tpl'}