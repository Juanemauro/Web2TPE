//VARIABLES
let captcha;

//EJECUCION DE FUNCIONES
generateCaptcha();

//EVENT LISTENERS
let actu = document.querySelector("#actucaptcha");
actu.addEventListener("click", generateCaptcha)
let rpedido = document.querySelector("#realizpedido");
rpedido.addEventListener("click", check)
let tres = document.querySelector("#tres");
tres.addEventListener("click", agregar3)
let borrar = document.querySelector("#borrartabla");
borrar.addEventListener("click", delete2)

//FUNCIONES CAPTCHA
function generateCaptcha() {
    let a = Math.floor((Math.random() * 10));
    let b = Math.floor((Math.random() * 10));
    let c = Math.floor((Math.random() * 10));
    let d = Math.floor((Math.random() * 10));

	captcha=a.toString()+b.toString()+c.toString()+d.toString();

    document.getElementById("captcha").value = captcha;
}

function check(){
	let input=document.getElementById("inputText").value;

	if(input==captcha){
		agregar();
		alert("Enviado");
	}
	else{
		alert("Verifique captcha");
	}
}

//JSON
let pedido1 = {
	"Nombre":{"value": "Joaquin"},
	"Apellido":{"value": "Tomasini"},
	"Direccion":{"value": "abc 123"},
	"Producto": {"value":"Pizza"}
}
let pedido2 = {
	"Nombre":{"value": "Juan"},
	"Apellido": {"value":"Mauro"},
	"Direccion":{"value": "cba 321"},
	"Producto":{"value": "Empanadas"}
}
let pedidos = [];
container= document.querySelector("#ultimos-pedidos");
pedidos[0]=pedido1;
pedidos[1]=pedido2;

mostrar();

function mostrar() {
	let html = "<table><tr><td>Nombre</td><td>Apellido</td><td>Direccion</td><td>Producto</td></tr>";
  for (let i = 0; i < pedidos.length; i++) {
    html += "<tr>"
    let nombre = pedidos[i].Nombre.value;
    let apellido = pedidos[i].Apellido.value;
    let direccion = pedidos[i].Direccion.value;
    let producto = pedidos[i].Producto.value;

    html += "<td>" + nombre + "</td>"
    html += "<td>" + apellido + "</td>"
    html += "<td>" + direccion + "</td>"
    html += "<td>" + producto + "</td>"
		html += "</tr>"
  }
	html+="</table>";
	container.innerHTML = html;
}

function agregar(){
	let nombre=document.querySelector("#inputName");
	let apellido=document.querySelector("#inputLastname");
	let direccion=document.querySelector("#inputAddress");
	let producto=document.querySelector("#inputPedido");

	let pedido ={
		"Nombre": nombre,
		"Apellido": apellido,
		"Direccion": direccion,
		"Producto": producto
	}

	let i=pedidos.length;
	pedidos[i]=pedido;
	mostrar();
}

function agregar3() {
  for (let i = 0; i < 3; i++) {
    agregar();
  }
}

function delete2(){
	pedidos.splice(0,pedidos.length);
	mostrar();
}