{literal}
<section id="vue-comentarios">
    <h4> {{ title }}<h4>
    <table class="pedidos_tabla"> 
        <thead>
            <tr>
                <th>Id comentario</th>
                <th>Usuario</th>
                <th>Comentario</th>
                <th>Puntaje</th>
                <th v-if="admin == 'true'">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="comentario in comentarios">
                <td>{{ comentario.id_comentario }}</td>
                <td>{{ comentario.id_usuario }}</td>
                <td>{{ comentario.texto }}</td>
                <td>{{ comentario.puntaje}}</td>
                <td v-if="admin == 'true'">
                    <button type="button" class="btn btn-danger" @click="remove(comentario.id_comentario)"> Eliminar</button>
                </td> 
            </tr>
        </tbody>
    </table>    
</section>  
{/literal}