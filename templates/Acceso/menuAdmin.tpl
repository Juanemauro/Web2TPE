{include 'templates/Acceso/header.tpl'}
<div class="slide">
        <table class="pedidos_tabla">
            <thead>
                <td>Alias</td>
                <td>Tipo de usuario</td>
                <td>Actualizar Permiso</td>
                <td>Eliminar</td>      
            </thead>
            {foreach  from=$usuarios item=usuario}
                <tr>
                    <td>{$usuario->alias}</td>
                    {if $usuario->admin eq 0}
                        <td><a class="navbar-brand mb- h1">Registrado</a></td>
                        <td><a href="updatePermiso/{$usuario->id_usuario}" class="btn btn-warning">Hacer administrador</a></td>
                        <td><a href="deleteUsuario/{$usuario->id_usuario}" class="btn btn-warning">Eliminar</a></td>
                    {else}
                        <td><a class="navbar-brand mb- h1" >Administrador</a></td>
                        <td><a href="updatePermiso/{$usuario->id_usuario}" class="btn btn-warning">Eliminar permiso</a></td>
                        <td><a href="deleteUsuario/{$usuario->id_usuario}" class="btn btn-warning">Eliminar</a></td>
                    {/if}                
                </tr>
            {/foreach}
        </table>  
{include 'templates/Acceso/footer.tpl'}
