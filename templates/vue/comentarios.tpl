{literal}
<section id="vue-comentarios">
    <h2>Opiniones:</h2>    
    <div v-if="!comentarios.length">
        <h2>Este pedido no tiene comentarios.</h2>
    </div>
    <div v-else>  
        <table class="pedidos_tabla"> 
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Puntaje</th>
                    <th v-if="admin == 'true'">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comentario in comentarios">     
                    <td>{{ comentario.alias }}</td>
                    <td>{{ comentario.texto }}</td>
                    <td>{{ comentario.puntaje}}</td>
                    <td v-if="admin == 'true'">
                        <button type="button" class="btn btn-danger" @click="remove(comentario.id_comentario)"> Eliminar</button>
                    </td> 
                </tr>
            </tbody>
        </table>
    </div> 
</section>  
{/literal}