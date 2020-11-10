"use strict"

// APP VUE
let app = new Vue({
    el: '#vue-comentarios',
    data: {
        title: 'Los usuarios que utilizaron El Azuleño opinaron..',
        comentarios: [],
        admin: ''
    },
    methods: {        
        remove: function(id_comentario){
            deleteComentario(id_comentario);
        }
    }
});

// CARGA INICIAL
document.addEventListener('DOMContentLoaded', () => {
    let id_pedido = document.querySelector("input[name=id_pedido]").value; // Obtengo el id del pedido
    let admin = document.querySelector('#admin').value; // Obtengo el id del pedido
    if(admin == 'true') { // Obtengo el valor de admin
        app.admin = 'true';
    }else{
        app.admin = 'false';
    }
    getComentarios(id_pedido);
    document.querySelector('#form-comentario').addEventListener('submit', e => {   
    // Evita el envio del formulario por default
    e.preventDefault();
    addComentario();
    });
});

// GET COMENTARIOS 
function getComentarios(id_pedido) {
    fetch('api/comentarios/' + id_pedido)
        .then(response => response.json())
        .then(comments =>
            // Para mostrar si el pedido no tiene comentarios, pero no funciona xD
            //{
            //    if (JSON.stringify(comments) == '{}'){
            //        comments = {'Este pedido no tiene comentarios.'};
            //    }
            //}
            //,
            app.comentarios = comments)
        .catch(error => console.log(error));
}

// ADD COMENTARIO
function addComentario(){
    //e.preventDefault();
    const comentario = {
        texto:  document.querySelector("textarea[name=texto]").value,
        puntaje:  document.querySelector("#puntaje option:checked").value,
        id_usuario:  document.querySelector("input[name=id_usuario]").value,
        id_pedido:  document.querySelector("input[name=id_pedido]").value
    }
    //console.log("comentario nuevo:")
    //console.log(comentario);
    fetch('api/comentario', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(comentario)
    })
    .then(response => {
        getComentarios(comentario.id_pedido); // Está bien hacer esto?
    })
    .catch(error => console.log(error));
}

// DELETE COMENTARIO
function deleteComentario(id_comentario) {
    //e.preventDefault(); Es necesario?
    let id_pedido = document.querySelector("input[name=id_pedido]").value;
    fetch('api/comentario/' + id_comentario, {
        method: 'DELETE',
        headers: {"Content-Type": "application/json"},
    })
    .then(response => {
        getComentarios(id_pedido); // Está bien hacer esto?
    })
    .catch(error => console.log(error));
}